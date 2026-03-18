<?php

namespace App\Services\Payment;
use Illuminate\Support\Facades\Log;

class RazorpayService implements PaymentGatewayInterface
{
    public function pay($amount)
    {
        log::info("Paid {$amount} via Razorpay");
        return "Paid {$amount} via Razorpay";
    }
}
