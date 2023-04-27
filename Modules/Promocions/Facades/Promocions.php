<?php

namespace TypiCMS\Modules\Promocions\Facades;

use Illuminate\Support\Facades\Facade;

class Promocions extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Promocions';
    }
}
