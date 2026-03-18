<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class SendWelcomEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Logic to send welcome email to the user
        Mail::to($this->user->email)->send(new WelcomeEmail($this->user));
    }
}
