<?php

namespace App\Events;

use App\Models\Workout;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WorkoutRecorded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $workout;
    public $user_id;
    public $user_name;
    public $workout_name;
    public $exercise_count;
    public $timestamp;

    /**
     * Create a new event instance.
     */
    public function __construct(Workout $workout, $user_id)
    {
        $this->workout = $workout;
        $this->user_id = $user_id;

        // Eager load relationships if not already loaded
        if (!$workout->relationLoaded('user')) {
            $workout->load('user');
        }

        if (!$workout->relationLoaded('exercises')) {
            $workout->load('exercises');
        }

        // Extract data to broadcast
        $this->user_name = $workout->user ? $workout->user->first_name . ' ' . $workout->user->last_name : 'User ' . $user_id;
        $this->workout_name = $workout->name ?? 'Workout on ' . $workout->date->format('M d, Y');
        $this->exercise_count = $workout->exercises->count();
        $this->timestamp = now()->format('Y-m-d H:i:s');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('workouts'),
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'WorkoutRecorded';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'workout' => [
                'id' => $this->workout->id,
                'name' => $this->workout_name,
                'exercise_count' => $this->exercise_count
            ],
            'user_name' => $this->user_name,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp
        ];
    }
}
