<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function store() {
        // validate
        $attributes = request()->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'], // email confirmation
            'password' => ['required', Password::min(8), 'confirmed'], // password_confirmation
        ]);

        // create user
        $user = User::create($attributes);

        // log in
        Auth::login($user);

        // redirect somewhere
        return redirect('/');
    }
}
