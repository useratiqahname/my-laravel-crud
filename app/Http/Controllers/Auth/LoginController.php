<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendMfaCode;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/todo';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Adjust if your login view is elsewhere
    }

    public function login(LoginRequest $request)
    {
        $key = $this->throttleKey($request);

        // Check if the user is locked out
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds."
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password . $user->salt, $user->password)) {
            RateLimiter::clear($key);
            // Generate 6-digit code
            $code = random_int(100000, 999999);
            $user->mfa_code = $code;
            $user->mfa_expires_at = now()->addMinutes(5);
            $user->save();

            //$user->notify(new SendMfaCode($code));

            session(['mfa_user_id' => $user->id]);
            return redirect()->route('mfa.verify.form');
        }

        RateLimiter::hit($key, 60);
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

}
