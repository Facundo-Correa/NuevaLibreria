<?php

namespace TypiCMS\Modules\Preguntas\Facades;

use Illuminate\Support\Facades\Facade;

class Preguntas extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Preguntas';
    }
}
