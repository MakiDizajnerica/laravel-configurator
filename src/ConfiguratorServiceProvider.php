<?php

namespace MakiDizajnerica\Configurator;

use Illuminate\Support\ServiceProvider;
use MakiDizajnerica\Configurator\ConfiguratorManager;

class ConfiguratorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/configurator.php', 'configurator');

        $this->app->singleton('configurator', fn ($app) => ConfiguratorManager::init($app->get('config')->get('configurator')));

        $this->app->get('configurator')->overwrite();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/configurator.php' => config_path('configurator.php')], 'configurator-config');

            if ($this->app->get('config')->get('configurator.default') === 'database') {
                $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            }
        }
    }
}
