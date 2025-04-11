<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MuscleGroup;
use App\Models\Exercise;

class MuscleGroupDataMigrationSeeder extends Seeder
{
    public function run(): void
    {
        $existingGroups = DB::table('exercises')
            ->select('muscle_group')
            ->distinct()
            ->get()
            ->pluck('muscle_group');

        foreach ($existingGroups as $groupName) {
            if (empty($groupName)) continue;

            $muscleGroup = MuscleGroup::firstOrCreate(
                ['name' => $groupName, 'user_id' => null],
                ['created_at' => now(), 'updated_at' => now()]
            );

            Exercise::where('muscle_group', $groupName)
                ->update(['muscle_group_id' => $muscleGroup->id]);
        }

        DB::table('users')->select('id')->get()->each(function($user) {
            DB::table('user_preferences')->insertOrIgnore([
                'user_id' => $user->id,
                'show_default_exercises' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
