<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function create()
    {
        return view('common.addPetInfo');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|numeric|min:0',
                'species' => 'required|string|max:255',
                'breed' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'color' => 'required|string|max:255',
                'size' => 'required|in:small,medium,large',
                'vaccinated' => 'required|boolean',
                'healthStatus' => 'required|array',
                'personality' => 'required|string|max:255',
                'description' => 'nullable|string',
                'photos.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'videos.*' => 'nullable|mimetypes:video/mp4,video/quicktime|max:20480'
            ]);

            // 处理照片
            $photoPaths = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('pets/photos', 'public');
                    $photoPaths[] = $path;
                }
            }

            // 处理视频
            $videoPaths = [];
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    $path = $video->store('pets/videos', 'public');
                    $videoPaths[] = $path;
                }
            }

            // 处理 species 和 breed
            $species = $request->species === 'other' ? $request->other_species : $request->species;
            $breed = $request->breed === 'other' ? $request->other_breed : $request->breed;

            // 处理 healthStatus
            $healthStatus = $request->healthStatus ?? [];
            if (in_array('other', $healthStatus) && $request->other_health_status) {
                $healthStatus = array_filter($healthStatus, fn($status) => $status !== 'other');
                $healthStatus[] = $request->other_health_status;
            }

            // 创建宠物记录
            Pet::create([
                'name' => $validated['name'],
                'age' => $validated['age'],
                'species' => $species,
                'breed' => $breed,
                'gender' => $validated['gender'],
                'color' => $validated['color'],
                'size' => $validated['size'],
                'vaccinated' => $validated['vaccinated'],
                'healthStatus' => $healthStatus,
                'personality' => $validated['personality'],
                'description' => $validated['description'],
                'photos' => $photoPaths,
                'videos' => $videoPaths,
                'addedBy' => auth()->id(),
                'addedByRole' => auth()->user()->role,
                'verified' => auth()->user()->role === 'admin'
            ]);

            return redirect()
                ->route('pets.create')
                ->with('success', '🎉 Pet information has been successfully added!');

        } catch (\Exception $e) {
            // 如果出错，删除已上传的文件
            if (!empty($photoPaths)) {
                foreach ($photoPaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
            if (!empty($videoPaths)) {
                foreach ($videoPaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }

            \Log::error('Error in pet store: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Failed to add pet information. Please try again.');
        }
    }

    //verification
    public function verify(Pet $pet)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $pet->update(['verified' => true]);
        return redirect()->back()->with('success', 'Pet has been verified successfully!');
    }

    public function reject(Pet $pet)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // 删除相关文件
        if ($pet->photos) {
            foreach (json_decode($pet->photos) as $photo) {
                Storage::delete($photo);
            }
        }
        if ($pet->videos) {
            foreach (json_decode($pet->videos) as $video) {
                Storage::delete($video);
            }
        }
        
        $pet->delete();
        return redirect()->back()->with('success', 'Pet has been rejected and removed.');
    }

    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $unverifiedPets = Pet::where('verified', false)
            ->with('user')  // 预加载用户关系
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.petInfoVerification', compact('unverifiedPets'));
    }
}
