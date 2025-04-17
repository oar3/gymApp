<?php

namespace Database\Factories;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;
use App\Models\User;
use App\Models\Workout;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workout>
 */
class WorkoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1000, 9000),
            'user_id' => User::all()->where('id', '>=', '4')->random()->id,
            'date' => fake()->dateTimeThisMonth(),
            'name' => fake()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
//            'created_at' => now(),
//            'updated_at' => now(),
            'notes' => fake()->text(100),
        ];
    }
}
