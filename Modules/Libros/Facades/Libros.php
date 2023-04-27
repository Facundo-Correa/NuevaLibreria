<?php

namespace TypiCMS\Modules\Libros\Facades;

use Illuminate\Support\Facades\Facade;

class Libros extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Libros';
    }
}
