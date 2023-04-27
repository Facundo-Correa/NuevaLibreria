<?php

namespace TypiCMS\Modules\Categorias\Facades;

use Illuminate\Support\Facades\Facade;

class Categorias extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Categorias';
    }
}
