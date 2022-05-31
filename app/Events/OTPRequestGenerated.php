<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OTPRequestGenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $country_code;
    public  $phone_number;
    public  $otp;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($country_code, $phone_number, $otp)
    {
        $this->country_code = $country_code;
        $this->phone_number = $phone_number;
        $this->otp = $otp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
