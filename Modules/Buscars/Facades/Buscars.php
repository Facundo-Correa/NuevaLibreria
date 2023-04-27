<?php

namespace TypiCMS\Modules\Buscars\Facades;

use Illuminate\Support\Facades\Facade;

class Buscars extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Buscars';
    }
}
