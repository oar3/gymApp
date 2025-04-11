<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;

class UserPreferenceController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            ['show_default_exercises' => $request->has('show_default_exercises')]
        );

        return back()->with('success', 'Display preferences updated successfully');
    }
}
