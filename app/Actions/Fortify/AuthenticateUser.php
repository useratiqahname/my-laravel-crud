<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Laravel\Fortify\Contracts\AuthenticateUserResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateUser implements LoginResponse
{
    public function toResponse($request)
    {
        return redirect()->intended(Fortify::redirects('login'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                Fortify::username() => [__('These credentials do not match our records.')],
            ]);
        }

        $saltedPassword = $request->password . $user->salt;

        if (!Hash::check($saltedPassword, $user->password)) {
            throw ValidationException::withMessages([
                Fortify::username() => [__('Authentication failed.')],
            ]);
        }

        Auth::login($user);

        return app(LoginResponse::class);
    }
}
