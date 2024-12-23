<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function index(Request $request)
    {
        try {
            // 获取筛选条件
            $species = $request->query('species');

            // 构建查询
            $query = Pet::where('verified', true);

            // 如果有物种筛选
            if ($species) {
                $query->where('species', $species);
            }

            // 获取分页数据
            $pets = $query->orderBy('created_at', 'desc')
                         ->paginate(6)
                         ->withQueryString();  // 保持 URL 参数

            // 添加调试信息
            \Log::info('Pets query executed', ['count' => $pets->count()]);

            return view('common.showAdpPet', compact('pets'));

        } catch (\Exception $e) {
            \Log::error('Error in AdoptionController@index: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the pets.');
        }
    }

    public function adopt(Pet $pet, Request $request)
    {
        // 确保用户已登录
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', '请先登录后再进行领养。');
        }

        // 检查是否已经有正在进行的申请
        $existingAdoption = Adoption::where('pet_id', $pet->id)
            ->where('user_id', auth()->id())
            ->whereIn('status', [Adoption::STATUS_PENDING, Adoption::STATUS_APPROVED])
            ->first();

        if ($existingAdoption) {
            $status = $existingAdoption->status === Adoption::STATUS_PENDING ? '审核中' : '已批准';
            return redirect()->back()->with('error', "您已经有一个{$status}的领养申请，请勿重复申请。");
        }

        // 检查宠物是否已经被其他人领养
        $adoptedByOthers = Adoption::where('pet_id', $pet->id)
            ->whereIn('status', [Adoption::STATUS_APPROVED, Adoption::STATUS_DONE])
            ->exists();

        if ($adoptedByOthers) {
            return redirect()->back()->with('error', '抱歉，这只宠物已经被领养了。');
        }

        // 创建新的领养申请
        $adoption = new Adoption();
        $adoption->pet_id = $pet->id;
        $adoption->user_id = auth()->id();
        $adoption->status = Adoption::STATUS_PENDING;
        $adoption->save();

        return redirect()->back()->with('success', '领养申请已提交，请等待审核。');
    }

    public function adoptionApplication(Request $request)
    {
        $status = $request->get('status', 'all');
        $query = Adoption::with(['pet', 'user'])
            ->where('user_id', auth()->id());

        // 根据状态筛选
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $adoptions = $query->latest()->paginate(10);

        // 获取各状态的数量
        $counts = [
            'all' => Adoption::where('user_id', auth()->id())->count(),
            'pending' => Adoption::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'approved' => Adoption::where('user_id', auth()->id())->where('status', 'approved')->count(),
            'rejected' => Adoption::where('user_id', auth()->id())->where('status', 'rejected')->count(),
            'done' => Adoption::where('user_id', auth()->id())->where('status', 'done')->count(),
        ];

        return view('common.adoptionApplication', compact('adoptions', 'status', 'counts'));
    }

    public function adminIndex(Request $request)
    {
        // 验证用户是否为管理员
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $status = $request->get('status', 'all');
        $query = Adoption::with(['pet', 'user']);

        // 根据状态筛选
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $adoptions = $query->latest()->paginate(10);

        // 获取各状态的数量
        $counts = [
            'all' => Adoption::count(),
            'pending' => Adoption::where('status', 'pending')->count(),
            'approved' => Adoption::where('status', 'approved')->count(),
            'rejected' => Adoption::where('status', 'rejected')->count(),
            'done' => Adoption::where('status', 'done')->count(),
        ];

        return view('admin.adoptionManagement', compact('adoptions', 'status', 'counts'));
    }

    public function updateStatus(Request $request, Adoption $adoption)
    {
        // 验证用户是否为管理员
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        // 验证请求数据
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected,done'  // 允许所有状态
        ]);

        try {
            // 更新状态
            $adoption->update([
                'status' => $validated['status']
            ]);
            if ($validated['status'] === 'done') {
                $adoption->pet->update(['adopted' => true]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error updating adoption status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating status'
            ], 500);
        }
    }
}
