<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Template;
use App\Policies\TemplatePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Template::class => TemplatePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Set the reset password URL
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return url(route('password.reset', [
                'token' => $token,
                'email' => $user->getEmailForPasswordReset(),
            ], false));
        });
    }
}
