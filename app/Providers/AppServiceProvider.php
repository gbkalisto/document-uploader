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
            // 1. Internal Disk Path (Keep this as is so Laravel can find the file)
            Vite::useBuildDirectory('../../public_html/build');

            // 2. Browser URL Path (Change this so the link in the source code looks correct)
            Vite::withEntryPoints(['resources/css/app.css', 'resources/js/app.js'])
                ->useManifestFilename('../../public_html/build/manifest.json');

            // If the above doesn't work, use this simpler override:
            Vite::useBuildDirectory('build');
        }
    }
}
