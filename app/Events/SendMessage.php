<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message) {
        $this -> message = $message;
    }

    public function broadcastOn() {

        return new Channel('channel_' . $this -> message -> chat -> company_id . "_" . $this -> message -> chat -> developer_id);

    }

    public function broadcastAs() {

        return 'channel-message';

    }

}
