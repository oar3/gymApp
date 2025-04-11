<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MuscleGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper to check if this is a default muscle group
    public function isDefault(): bool
    {
        return is_null($this->user_id);
    }
}
