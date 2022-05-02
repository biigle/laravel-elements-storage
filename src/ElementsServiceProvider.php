<?php

namespace Biigle\Filesystem;

use GuzzleHttp\Client;
use Illuminate\Filesystem\FilesystemAdapter;
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
            $adapter = new ElementsAdapter($client, $config['prefix'] ?? '');

            return new FilesystemAdapter(new Filesystem($adapter), $adapter, $config);
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
}
