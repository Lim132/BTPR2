<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DonationsExport;

class DonationController extends Controller
{
    public function showDonationForm()
    {
        return view('common.donation');
    }

    public function paymentPost(Request $request)
    {
        // dd($request);
        try {
            $request->validate([
                'amount' => 'required|numeric|min:1',
                'donor_name' => 'nullable|string',
                'donor_email' => 'required|email',
                'message' => 'nullable|string',
                'stripeToken' => 'required'
            ]);

            Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            
            // if (!$request->stripeToken) {
            //     throw new \Exception('Payment token not provided.');
            // }
                $charge = Stripe\Charge::create([
                    "amount" => $request->amount * 100,
                    "currency" => "MYR",
                    "source" => $request->stripeToken,
                    "description" => "Donation to Pet4U",
                    "metadata" => [
                        "donor_name" => $request->donor_name ?? 'Anonymous',
                        "donor_email" => $request->donor_email,
                        "message" => $request->message
                    ]
                    ]);

                // 保存捐赠记录
                $donation = Donation::create([
                    'user_id' => auth()->id(),
                    'amount' => $request->amount,
                    'currency' => 'MYR',
                    'stripe_payment_id' => $charge->id,
                    'donor_name' => $request->donor_name ?? 'Anonymous',
                    'donor_email' => $request->donor_email,
                    'message' => $request->message
                ]);
                
            return redirect()->route('donation.thank-you', ['donation' => $donation->id])->with('success', 'Thank you for your donation!');
        } catch (\Exception $e) {
            \Log::error('Stripe error: ' . $e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function showThankYou($donationId)
    {
        $donation = Donation::findOrFail($donationId);
        
        // 添加权限检查
        if (auth()->check()) {
            if ($donation->user_id !== auth()->id()) {
                abort(403, 'Unauthorized access');
            }
        } elseif ($donation->created_at->diffInMinutes(now()) > 30) {
            // 如果是游客，只允许查看30分钟内的捐款
            abort(403, 'This donation record has expired');
        }
        
        return view('common.donation-thank-you', compact('donation'));
    }

    public function showDonationRecords()
    {
        $donations = Donation::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        
        return view('common.donationRecords', compact('donations'));
    }

    public function generateReceipt($id)
    {
        $donation = Donation::findOrFail($id);
        
        // 验证用户权限
        if ($donation->user_id !== auth()->id() && !auth()->user()->role == 'admin') {
            abort(403, 'Unauthorized access');
        }

        // 生成收据编号
        $receiptNo = 'RCP-' . str_pad($donation->id, 10, '0', STR_PAD_LEFT);

        // 生成 PDF
        $pdf = PDF::loadView('common.donation-receipt', [
            'donation' => $donation,
            'receiptNo' => $receiptNo,
            'date' => Carbon::parse($donation->created_at)->format('d M Y'),
        ]);

        // 设置 PDF 文件名
        $filename = 'donation-receipt-' . $donation->id . '.pdf';

        // 返回下载响应
        return $pdf->download($filename);
    }





    public function showDonationRecordsAdmin(Request $request)
    {
        $query = Donation::query();

        // 搜索
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('donor_name', 'like', "%{$request->search}%")
                  ->orWhere('donor_email', 'like', "%{$request->search}%");
            });
        }

        // 金额过滤
        if ($request->amount_filter) {
            list($min, $max) = explode('-', $request->amount_filter);
            if ($max == '+') {
                $query->where('amount', '>', $min);
            } else {
                $query->whereBetween('amount', [$min, $max]);
            }
        }

        // 日期过滤
        if ($request->date_filter) {
            switch ($request->date_filter) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month);
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }

        // 统计数据直接使用单独的变量，而不是数组
        $totalAmount = Donation::sum('amount');
        $totalDonors = Donation::distinct('donor_email')->count();
        $todayAmount = Donation::whereDate('created_at', today())->sum('amount');
        $monthAmount = Donation::whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                              ->sum('amount');

        $donations = $query->latest()->paginate(15);

        return view('admin.donationRecordsAdm', compact(
            'donations',
            'totalAmount',
            'totalDonors',
            'todayAmount',
            'monthAmount'
        ));
    }

    public function export()
    {
        return Excel::download(new DonationsExport, 'donations.xlsx');
    }

    public function show($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donation-details', compact('donation'));
    }

    // 用户查看自己的捐款记录
    public function userDonations()
    {
        $donations = Donation::where('donor_email', auth()->user()->email)
                           ->latest()
                           ->paginate(10);
        return view('common.donationRecords', compact('donations'));
    }
    
}
