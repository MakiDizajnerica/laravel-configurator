<?php

namespace MakiDizajnerica\Configurator\Facades;

use Illuminate\Support\Facades\Facade;

class Configurator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'configurator';
    }
}
