<?php

if (! function_exists('configurator')) {
    /**
     * 
     *
     * @param  array|string $key
     * @param  mixed $value
     * @return \MakiDizajnerica\Configurator\ConfiguratorManager|void
     */
    function configurator()
    {
        $arguments = func_get_args();
        $configurator = app('configurator');

        if (empty($arguments)) {
            return $configurator;
        }

        return $configurator->set($arguments[0], $arguments[1] ?? null);
    }
}
