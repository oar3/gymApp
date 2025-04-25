<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    /**
     * Display the password reset request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Find the user
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            // Generate token
            $token = Str::random(64);

            // Store token in password_reset_tokens table
            \DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            \DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => Hash::make($token),
                'created_at' => now()
            ]);

            // Generate reset URL
            $resetUrl = url(route('password.reset', [
                'token' => $token,
                'email' => $user->email,
            ], false));

            // Send custom email
            Mail::send('mail.reset-password', ['url' => $resetUrl], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Reset Your Password - ' . config('app.name'));
            });

            return back()->with('status', 'We have emailed your password reset link!');
        }

        return back()->withErrors(['email' => 'We could not find a user with that email address.']);
    }

    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function reset(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->route('token'),
            'email' => $request->email
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        // Find token record
        $tokenRecord = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        // Verify token
        if (!$tokenRecord || !Hash::check($request->token, $tokenRecord->token)) {
            return back()->withErrors(['email' => 'This password reset link is invalid or has expired.']);
        }

        // Find user
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Delete used token
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset!');
    }
}
