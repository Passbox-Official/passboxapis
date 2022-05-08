<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Responser extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'responser';
    }
}
