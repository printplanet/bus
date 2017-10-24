<?php

namespace Printplanet\Component\Bus;

use Printplanet\Component\Support\ServiceProvider;
use Printplanet\Component\Contracts\Queue\Factory as QueueFactoryContract;

class BusServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Dispatcher::CLASSNAME, function ($app) {
            return new Dispatcher($app, function ($connection = null) use ($app) {
                return $app[QueueFactoryContract::CLASSNAME]->connection($connection);
            });
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            Dispatcher::CLASSNAME,
        );
    }
}
