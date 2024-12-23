<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function showAvatarEdit() {
        return view('common.editAvatar');
    }
    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $user = auth()->user();

            // 如果用户已有头像，先删除旧的
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // 存储新头像
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            
            // 更新用户头像路径
            $user->update([
                'avatar' => $avatarPath
            ]);

            return redirect()
                ->back()
                ->with('success', 'Avatar updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Avatar update error: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to update avatar. Please try again.');
        }
    }

    public function updateUsername(Request $request)
    {
        // 验证输入
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
        ]);
        // 获取当前用户
        $user = Auth::user();
        // 更新用户名
        $user->username = $request->username;
        $user->save();
        // 返回成功消息
        return redirect()->back()->with('success', 'Username updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        // 验证输入
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        // 检查当前密码是否正确
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        // 更新密码
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('successChangePassword', 'Password updated successfully.');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);
        $user = Auth::user();
        $user->address = $request->address;
        $user->save();
        return back()->with('successUpdateAddress', 'Address updated successfully.');
    }


}
