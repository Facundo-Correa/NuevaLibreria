<?php

namespace TypiCMS\Modules\Books\Facades;

use Illuminate\Support\Facades\Facade;

class Books extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Books';
    }
}
