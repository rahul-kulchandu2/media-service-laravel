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
            __DIR__ . '/App/Facades/MediaServiceFacade.php' => app_path('Facades/MediaServiceFacade.php'),
        ]);
    }
    public function register()
    {
        $this->app->bind('media-service', function ($app) {
            return new MediaService();
        });
    }
}
