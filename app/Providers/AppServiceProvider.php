<?php

namespace App\Providers;

use App\Events\WorkoutRecorded;
use App\Listeners\SendWorkoutNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event;
use App\Models\Exercise;
use App\Models\Workout;
use App\Models\User;
use App\Policies\ExercisePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Model::preventLazyLoading();

        Gate::policy(Exercise::class, ExercisePolicy::class);

        Gate::define('edit-exercise', function (User $user, Exercise $exercise) {
            return $workout->user_id == $user->id;
        });

        Event::listen(
          WorkoutRecorded::class,
          SendWorkoutNotification::class
        );
    }
}
