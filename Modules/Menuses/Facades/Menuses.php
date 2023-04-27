<?php

namespace TypiCMS\Modules\Menuses\Facades;

use Illuminate\Support\Facades\Facade;

class Menuses extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Menuses';
    }
}
