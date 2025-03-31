<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'exercise' => fake()->randomElement(Exercise::all()),
            'sets' => random_int(1, 10),
            'reps' => random_int(1, 40),
            'weight' => random_int(1, 100),
            'units' => 'KGs',
            'workout_id' => Workout::factory()
        ];
    }
}
