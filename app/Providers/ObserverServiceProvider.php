<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Profile;
use App\Observers\ProductObserver;
use App\Observers\ProfileObserver;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        Profile::observe(ProfileObserver::class);
    }
}
