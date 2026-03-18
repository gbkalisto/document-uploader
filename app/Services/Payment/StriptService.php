<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Log;

class StriptService implements PaymentGatewayInterface
{
    public function pay($amount)
    {
        Log::info("Paid {$amount} via Stript");
        return "Paid {$amount} via Stript";
    }
}
