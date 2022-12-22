<?php

namespace Elaboratecode\ValidDataFaker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Elaboratecode\ValidDataFaker\ValidDataFaker
 */
class ValidDataFaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Elaboratecode\ValidDataFaker\ValidDataFaker::class;
    }
}
