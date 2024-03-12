<?php

namespace Kulchandu\MediaService\App\Facades;

use Illuminate\Support\Facades\Facade;

class MediaServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'media-service'; // The binding identifier in the service container
    }
}
