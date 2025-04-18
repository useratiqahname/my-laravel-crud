<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nickname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_no' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        dd($data);
        $user->update($data);

        return redirect()->route('profile.edit')->with('success', 'Profile updated.');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

    // Optional: delete avatar from storage if needed
    // Storage::delete('public/avatars/' . $user->avatar);

        Auth::logout();
        $user->delete();

    return redirect('/')->with('status', 'Your account has been deleted.');
    }
}
