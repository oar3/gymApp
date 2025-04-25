<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\Rules\Password;
    use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    public function editPassword()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::min(8), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Password updated successfully.');
    }
}

