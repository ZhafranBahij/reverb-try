<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // you can use this variable if you call event for listener
    public $username, $message;

    /**
     * Create a new event instance.
     */
    public function __construct($user_id, $message)
    {
        $message = Message::create([
            'user_id' => $user_id,
            'message' => $message,
        ]);

        $this->username = $message->user->name;
        $this->message = $message->message;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Name Channel
        return [
            new Channel('message-channel'),
        ];
    }
}
