<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Payment\PaymentGatewayInterface;
use App\Services\Payment\RazorpayService;
use App\Services\Payment\StriptService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayInterface::class , RazorpayService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
