<?php

namespace MakiDizajnerica\Configurator;

use Illuminate\Support\Arr;
use MakiDizajnerica\Configurator\Exceptions\ConfiguratorDriverException;

class ConfiguratorManager
{
    /** @param \MakiDizajnerica\Configurator\Contracts\ConfiguratorDriver */
    protected $driver;

    /**
     * @param  array $driver
     * @return void
     */
    private function __construct($driver)
    {
        $this->driver = $driver;
    }

    /**
     * Initialize configurator manager.
     * 
     * @param  array $config
     * @return \MakiDizajnerica\Configurator\ConfiguratorManager
     */
    public static function init($config): self
    {
        $default = Arr::get($config, 'default');

        if (! $default) {
            throw new ConfiguratorDriverException('Configurator default driver not defined.');
        }

        $driver = Arr::get($config, "drivers.{$default}");

        if (! $driver) {
            throw new ConfiguratorDriverException("Configurator driver '{$default}' not defined.");
        }

        $driverClass = Arr::get($driver, 'driver');
        $driverConfig = Arr::except($driver, 'driver');

        if (! class_exists($driverClass)) {
            throw new ConfiguratorDriverException("Configurator driver class '{$driverClass}' not defined.");
        }

        return new static(new $driverClass($driverConfig));
    }

    /**
     * Overwrite default Laravel config values.
     * 
     * @return void
     */
    public function overwrite(): void
    {
        app('config')->set($this->driver->get());
    }

    public function __call($name, $arguments)
    {
        if (! method_exists($this->driver, $name)) {
            $driverClass = get_class($this->driver);

            throw new ConfiguratorDriverException("Configurator driver method '{$driverClass}::{$name}' not defined.");
        }

        return $this->driver->{$name}(...$arguments);
    }
}
