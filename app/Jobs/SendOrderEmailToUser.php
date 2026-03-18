<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOrderEmail;
use App\Models\User;

class SendOrderEmailToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $order;

    public function __construct($order)
    {
        // Pass the whole Order model here
        $this->order = $order;
    }

    public function handle(): void
    {
        // Use the relationship you already defined in your Order model
        $user = $this->order->user;

        if ($user) {
            Mail::to($user->email)->send(new SendOrderEmail($this->order));
        }
    }
}
