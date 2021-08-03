<?php

namespace Biigle\Filesystem;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Config;
use League\Flysystem\Filesystem;

class ElementsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['filesystem']->extend('elements', function($app, $config) {
            $client = new Client([
                'base_uri' => $config['baseUri'],
                'headers' => [
                    'Authorization' => 'Bearer '.$config['token'],
                ],
            ]);
            $adapter = new ElementsAdapter($client, $config['prefix'] ?? null);

            return new Filesystem($adapter, $this->getFlyConfig($config));
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Create the Flysystem configuration.
     *
     * @param array $config
     *
     * @return Config
     */
    protected function getFlyConfig($config)
    {
        $flyConfig = new Config([
            'disable_asserts' => Arr::get($config, 'disableAsserts', false),
        ]);

        return $flyConfig;
    }
}
