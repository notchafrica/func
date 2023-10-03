<?php

namespace NotchAfrica\Func\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NotchAfrica\Func\Func
 */
class Func extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \NotchAfrica\Func\Func::class;
    }
}
