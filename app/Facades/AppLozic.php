<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AppLozic extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Facades\Supplements\AppLozic::class;
    }
}
