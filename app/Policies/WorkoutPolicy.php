<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Auth\Access\Response;
class WorkoutPolicy
{

    public function viewAny(User $user): bool
    {
        if($user->is_admin != 1){
            return true;
        }
        else {
            return false;
        }
    }

    public function view(User $user, Workout $workout): Response
    {
        return $user->id === $workout->user_id
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }

    public function show(User $user, Workout $workout): Response
    {
        if($user->is_admin != 1) {
            return $user->id === $workout->user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
        else {
            return Response::allow();
        }
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Workout $workout): Response
    {
        return $user->id === $workout->user_id
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }

    public function edit(User $user, Workout $workout): Response
    {
        return $user->id === $workout->user_id
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Workout $workout): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Workout $workout): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Workout $workout): bool
    {
        //
    }
}
