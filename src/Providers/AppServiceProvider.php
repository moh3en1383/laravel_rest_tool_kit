<?php
namespace LaravelRestToolKit\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        // Publish configuration, views, and other resources to app directory
        $this->publishes([
            __DIR__.'/../../src' => app_path('LaravelRestToolKit'),
        ], 'laravel-rest-tool-kit');
    }
}
