<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'muscle_group', 'description'];

    /**
     * The workouts that belong to the exercise.
     */
    public function workouts(): BelongsToMany
    {
        return $this->belongsToMany(Workout::class)
            ->withPivot('sets', 'repetitions', 'weight', 'unit', 'name')
            ->withTimestamps();
    }

    /**
     * Get all exercises from the database.
     * This provides a similar interface to the static array method
     * but pulls data from the database instead.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllExercises(): \Illuminate\Database\Eloquent\Collection
    {
        return self::orderBy('name')->get();
    }

    /**
     * Get exercises grouped by muscle group.
     *
     * @return array
     */
    public static function getExercisesByMuscleGroup(): array
    {
        return self::orderBy('muscle_group')
            ->orderBy('name')
            ->get()
            ->groupBy('muscle_group')
            ->toArray();
    }

    /**
     * Get all unique muscle groups.
     *
     * @return array
     */
    public static function getMuscleGroups(): array
    {
        return self::select('muscle_group')
            ->distinct()
            ->orderBy('muscle_group')
            ->pluck('muscle_group')
            ->toArray();
    }

    /**
     * Scope a query to get exercises by muscle group.
     */
    public function scopeByMuscleGroup($query, $muscleGroup)
    {
        return $query->where('muscle_group', $muscleGroup);
    }
}
