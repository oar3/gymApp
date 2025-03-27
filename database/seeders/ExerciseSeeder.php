<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            ['name' => 'Squat', 'muscle_group' => 'Legs'],
            ['name' => 'Bench Press', 'muscle_group' => 'Chest'],
            ['name' => 'Deadlift', 'muscle_group' => 'Back'],
            ['name' => 'Bicep Curls', 'muscle_group' => 'Arms'],
            ['name' => 'Shoulder Press', 'muscle_group' => 'Shoulders'],
            ['name' => 'Lat Pulldown', 'muscle_group' => 'Back'],
            ['name' => 'Leg Press', 'muscle_group' => 'Legs'],
            ['name' => 'Tricep Extensions', 'muscle_group' => 'Arms'],
            ['name' => 'Calf Raises', 'muscle_group' => 'Legs'],
            ['name' => 'Pull-ups', 'muscle_group' => 'Back']
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
