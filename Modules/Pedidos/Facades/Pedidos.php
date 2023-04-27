<?php

namespace TypiCMS\Modules\Pedidos\Facades;

use Illuminate\Support\Facades\Facade;

class Pedidos extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Pedidos';
    }
}
