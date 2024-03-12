<?php

namespace Kulchandu\MediaService;

use Illuminate\Support\ServiceProvider;
use Kulchandu\MediaService\Services\MediaService;

class MediaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Services/MediaService.php' => app_path('Services/MediaService.php'),
        ]);
    }
    public function register()
    {
        $this->app->singleton('media', function ($app) {
            return new MediaService();
        });
        $this->app->bind('media-service', function ($app) {
            return new MediaService();
        });
    }
}
