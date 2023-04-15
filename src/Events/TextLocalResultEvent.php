<?php

namespace Hmimeee\TextLocal\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TextLocalResultEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance of Sent SMS
     * 
     * @param mixed $data
     */
    public function __construct(public mixed $data)
    {
        //
    }
}
