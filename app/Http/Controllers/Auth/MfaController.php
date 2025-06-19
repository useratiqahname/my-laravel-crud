<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MfaController extends Controller
{
    public function showVerifyForm()
    {
        return view('auth.mfa');
    }

    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $user = User::find(session('mfa_user_id'));

        if (!$user || $user->mfa_code !== $request->code || now()->greaterThan($user->mfa_expires_at)) {
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }

        session()->forget('mfa_user_id');

        $user->mfa_code = null;
        $user->mfa_expires_at = null;
        $user->save();

        Auth::login($user);

        // Redirect based on role
        if ($user->role && $user->role->role_name === 'admin') {
            return redirect('/admin');
        }

        return redirect('/todo'); // or role-based redirect
    }
}
