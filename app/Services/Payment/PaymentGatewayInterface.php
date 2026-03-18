<?php

namespace App\Services\Payment;

interface PaymentGatewayInterface
{
    public function pay($amount);
}
