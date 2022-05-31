<?php

namespace App\Listeners;

use App\Events\OTPRequestGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Libs\MSG91;

class SendOTP implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MSG91 $msg91)
    {
        $this->sms_gateway = $msg91;
    }

    /**
     * Handle the event.
     *
     * @param  OTPRequestGenerated  $event
     * @return void
     */
    public function handle(OTPRequestGenerated $event)
    {
        $this->sms_gateway->sentOTP(
                                        $event->country_code,
                                        $event->phone_number,
                                        $event->otp
                                    );
    }
}
