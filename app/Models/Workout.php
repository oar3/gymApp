<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
      'date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class)
            ->withPivot('sets', 'repetitions', 'weight', 'unit')
            ->withTimestamps();
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->workout->id,
            'name' => $this->workout->name,
            'user_id' => $this->user_id
        ];
    }
}
