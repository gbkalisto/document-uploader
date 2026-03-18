<?php

namespace App\Services;

use App\Models\Order;
use App\Events\OrderEvent;
use Illuminate\Support\Facades\DB;
use App\Services\Payment\PaymentGatewayInterface;

class OrderService
{

    public $paymentGateway;
    public function __construct(PaymentGatewayInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }
    public function processOrder($user, $product)
    {
        return DB::transaction(function () use ($user, $product) {
            $order = Order::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'order_number' => uniqid('order_'),
                'price_at_purchase' => $product->price,
                'status' => 'pending',
            ]);
            // use payment gateway to process payment using interface and service provider
            $this->paymentGateway->pay($product->price);
            event(new OrderEvent($order));
            return $order;
        });
    }
}
