<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Template;
use Illuminate\Auth\Access\Response;

class TemplatePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Template $template): Response
    {
        return $user->id === $template->user_id
            ? Response::allow()
            : Response::deny('You do not own this template.');
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Template $template): Response
    {
        return $user->id === $template->user_id
            ? Response::allow()
            : Response::deny('You do not own this template.');
    }

    public function edit(User $user, Template $template): Response
    {
        return $user->id === $template->user_id
            ? Response::allow()
            : Response::deny('You do not own this template.');
    }

    public function delete(User $user, Template $template): Response
    {
        return $user->id === $template->user_id
            ? Response::allow()
            : Response::deny('You do not own this template.');
    }
}
