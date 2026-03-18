<?php

namespace App\Listeners;

use App\Events\UserRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\SendWelcomEmail;

class SendEmailToUser implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistration $event): void
    {
        $user = $event->user;
        SendWelcomEmail::dispatch($user);
        // Logic to send email to the user
    }
}
