<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Vite;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Post::class, PostPolicy::class);
        RateLimiter::for('emails', function (object $job) {
            return Limit::perMinute(2);
        });

        // Otherwise (Local), use the default 'build' directory
        if (file_exists(base_path('../public_html'))) {
            Vite::useBuildDirectory('../../public_html/build');

            // Force the asset URL to point to your domain root
            Vite::useHotFile(base_path('../public_html/hot'));
        }
    }
}
