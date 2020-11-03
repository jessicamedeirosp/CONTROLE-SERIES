<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SerieApagada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

 
    public $serie;

    public function __construct(Object $serie)
    {
        $this->serie = $serie;
    }

  
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
