<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Database\Seeder;

class UserPreferencesSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            UserPreference::updateOrCreate(
                ['user_id' => $user->id],
                ['show_default_exercises' => true]
            );
        }
    }
}
