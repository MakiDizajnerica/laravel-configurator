<?php

namespace MakiDizajnerica\Configurator\Drivers;

use MakiDizajnerica\Configurator\ConfiguratorDriver;
use MakiDizajnerica\Configurator\Contracts\ConfiguratorDriver as ConfiguratorDriverContract;

class Cache extends ConfiguratorDriver implements ConfiguratorDriverContract // @todo
{
    /**
     * Get config from defined driver.
     * 
     * @return array
     */
    public function get(): array
    {
        return [];
    }

    /**
     * Set a given configuration value.
     *
     * @param  array|string $key
     * @param  mixed $value
     * @return void
     */
    public function set($key, $value = null): void
    {
        //
    }
}
