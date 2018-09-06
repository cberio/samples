<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class QuickBlox extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Facades\Supplements\QuickBlox::class;
    }
}
