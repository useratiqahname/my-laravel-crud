<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'nickname' => 'nullable|string|max:255',
        'phone_no' => 'nullable|string|max:20',
        'city' => 'nullable|string|max:255',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle avatar upload if provided
    if ($request->hasFile('avatar')) {
        $avatarName = time() . '_' . $request->avatar->getClientOriginalName();
        $request->avatar->move(public_path('avatars'), $avatarName);
        $user->avatar = $avatarName;
    }

    // These should happen regardless of whether avatar is uploaded
    $user->nickname = $request->nickname;
    $user->phone_no = $request->phone_no;
    $user->city = $request->city;

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}


    public function destroy()
    {
        $user = Auth::user();
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
