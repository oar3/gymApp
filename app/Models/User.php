<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function workout() {
        return $this->hasMany(Workout::class);
    }

    public function muscleGroups()
    {
        return $this->hasMany(MuscleGroup::class);
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }

    public function preferences()
    {
        return $this->hasOne(UserPreference::class);
    }

    /**
     * Get the email address used for password resets.
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->email;
    }

    /**
     * Get the amount of seconds that the reset token should be considered valid.
     */
    public function getPasswordResetTokenExpireInSeconds(): int
    {
        return 60 * 60; // 1 hour
    }
}
