<?php

namespace TypiCMS\Modules\Contadores\Facades;

use Illuminate\Support\Facades\Facade;

class Contadores extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Contadores';
    }
}
