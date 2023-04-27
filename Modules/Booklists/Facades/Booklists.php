<?php

namespace TypiCMS\Modules\Booklists\Facades;

use Illuminate\Support\Facades\Facade;

class Booklists extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Booklists';
    }
}
