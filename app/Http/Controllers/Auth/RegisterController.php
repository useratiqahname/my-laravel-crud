<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;  // <-- This trait adds showRegistrationForm() and other necessary methods

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return redirect($this->redirectPath());
    }

    protected function create(array $data)
    {
        \Log::info('✅ create() method was called');

        $salt = Str::random(16); // Generate a 16-character random salt
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'salt'     => $salt,
            'password' => Hash::make($data['password'] . $salt),
            'role'     => 'user', // Default role for new users
        ]);
    }

}

