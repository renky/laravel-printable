<?php

namespace Orlyapps\Printable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Orlyapps\Printable\Printable
 */
class PrintableFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-printable';
    }
}
