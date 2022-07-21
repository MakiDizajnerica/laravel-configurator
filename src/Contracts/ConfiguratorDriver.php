<?php

namespace MakiDizajnerica\Configurator\Contracts;

interface ConfiguratorDriver
{
    /**
     * Get config from defined driver.
     * 
     * @return array
     */
    public function get(): array;

    /**
     * Set a given configuration value.
     *
     * @param  array|string $key
     * @param  mixed $value
     * @return void
     */
    public function set($key, $value = null): void;
}
