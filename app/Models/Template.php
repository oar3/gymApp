<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Template extends Model
{
    /** @use HasFactory<\Database\Factories\TemplateFactory> */
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the template.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The exercises that belong to the template.
     */
    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class)
            ->withPivot('sets', 'repetitions', 'weight', 'unit')
            ->withTimestamps();
    }
}
