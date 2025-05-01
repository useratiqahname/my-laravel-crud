<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\MFAEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class MFAController extends Controller
{
    public function verifyForm()
    {
        return view('auth.verify-mfa');
    }

    public function verify(Request $request)
    {
        $request->validate(['code' => 'required']);
        if ($request->code == Session::get('mfa_code')) {
            Session::forget('mfa_code');
            Session::put('mfa_passed', true);
            return redirect()->intended('dashboard');
        }
        return redirect()->back()->withErrors(['code' => 'Invalid MFA code']);
    }

    public function sendCode()
    {
        $user = Auth::user();
        dd($user);
        
        $code = rand(100000, 999999);
        Session::put('mfa_code', $code);
        $user->notify(new MFAEmail($code));
        return redirect()->route('mfa.form');
    }
}
