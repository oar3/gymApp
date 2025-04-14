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
    public function muscleGroup()
    {
        return $this->belongsTo(MuscleGroup::class);
    }

    public static function getExercisesByMuscleGroup(?int $userId = null): array
    {
        $query = self::with('muscleGroup')
            ->orderBy('name');

        if ($userId) {
            $user = User::find($userId);
            $showDefaults = $user && $user->preferences ? $user->preferences->show_default_exercises : true;

            $query->where(function($q) use ($userId, $showDefaults) {
                $q->where('user_id', $userId);

                if ($showDefaults) {
                    $q->orWhereNull('user_id');
                }
            });
        }

        $exercises = $query->get();

        return $exercises->groupBy(function($exercise) {
            return $exercise->muscleGroup ? $exercise->muscleGroup->name : $exercise->muscle_group;
        })->toArray();
    }

    public static function getMuscleGroups(?int $userId = null): array
    {
        $query = MuscleGroup::query()->orderBy('name');

        if ($userId) {
            $user = User::find($userId);
            $showDefaults = $user && $user->preferences ? $user->preferences->show_default_exercises : true;

            $query->where(function($q) use ($userId, $showDefaults) {
                $q->where('user_id', $userId);

                if ($showDefaults) {
                    $q->orWhereNull('user_id');
                }
            });
        } else {
            $query->whereNull('user_id');
        }

        return $query->pluck('name')->toArray();
    }

    /**
     * Scope a query to get exercises by muscle group.
     */
    public function scopeByMuscleGroup($query, $muscleGroup)
    {
        return $query->where('muscle_group', $muscleGroup);
    }
}
