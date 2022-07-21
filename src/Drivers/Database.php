<?php

namespace MakiDizajnerica\Configurator\Drivers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use MakiDizajnerica\Configurator\ConfiguratorDriver;
use MakiDizajnerica\Configurator\Contracts\ConfiguratorDriver as ConfiguratorDriverContract;

class Database extends ConfiguratorDriver implements ConfiguratorDriverContract
{
    /**
     * Get config from defined driver.
     * 
     * @return array
     */
    public function get(): array
    {
        if (! empty($this->config)) {
            return $this->config;
        }

        $table = DB::table('configurator')->select(['config'])->find(1);

        if (! $table) {
            return [];
        }

        return $this->config = json_decode($table->config, true);
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
        $config = array_merge($this->get(), is_array($key) ? $key : [$key => $value]);

        DB::table('configurator')->updateOrInsert(['id' => 1], ['config' => json_encode($config)]);

        $this->config = $config;
    }

    /**
     * 
     * @param  array|string $key
     * @return void
     */
    public function unset($key)
    {
        $config = $this->get();

        Arr::forget($config, is_array($key) ? $key : [$key]);

        DB::table('configurator')->updateOrInsert(['id' => 1], ['config' => json_encode($config)]);

        $this->config = $config;
    }
}
