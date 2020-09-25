<?php

namespace MG\Inbox;

use Illuminate\Support\ServiceProvider;

/**
 * Class InboxServiceProvider.
 */
class InboxServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Config
        $this->publishes([
            __DIR__.'/../../config/laravel-inbox.php' => config_path('laravel-inbox.php'),
        ]);

        // Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
