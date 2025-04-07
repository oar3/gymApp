<?php

namespace App\Policies;

use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Auth\Access\Response;

class ExercisePolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Exercise $exercise): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
//        return false;
    }

    public function delete(User $user, Exercise $exercise): Response
    {
        if($user->is_admin != 1) {
            return $user->id === $exercise->user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
        else {
            return Response::allow();
        }
    }

    public function update(User $user, Exercise $exercise): Response
    {
        if($user->is_admin != 1) {
            return $user->id === $exercise->user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
        else {
            return Response::allow();
        }
    }

    public function edit(User $user, Exercise $exercise): Response
    {
        if($user->is_admin != 1) {
            return $user->id === $exercise->user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
        else {
            return Response::allow();
        }
    }

    public function destroy(User $user, Exercise $exercise): Response
    {
        if($user->is_admin != 1) {
            return $user->id === $exercise->user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
        else {
            return Response::allow();
        }
    }

    public function restore(User $user, Exercise $exercise): bool
    {
        return false;
    }

    public function forceDelete(User $user, Exercise $exercise): bool
    {
        return false;
    }
}
