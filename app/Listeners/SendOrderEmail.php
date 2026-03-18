<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Jobs\SendOrderEmailToUser;

class SendOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
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
    public function handle(OrderEvent $event): void
    {
        // Handle the event, for example, send an email to the user
        $order = $event->order;
        $user = User::find($order->user_id);
        SendOrderEmailToUser::dispatch($order);
    }
}
