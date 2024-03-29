<?php

namespace domain\Facades;

use domain\Services\ImageService;
use Illuminate\Support\Facades\Facade;

class ImageFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ImageService::class;
    }
}