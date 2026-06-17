<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Log;

class SendOrderConfirmationEmail
{
    public function handle(OrderPlaced $event): void
    {
        Log::info(
            'Order Created : ' . $event->order->id
        );
    }
}