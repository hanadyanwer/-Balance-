<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Story;

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
        // Share pending stories count with all admin views
        View::composer('admain*', function ($view) {
            $pendingStoriesCount = Story::where('is_approved', false)->count();
            $view->with('pendingStoriesCount', $pendingStoriesCount);
        });
    }
}
