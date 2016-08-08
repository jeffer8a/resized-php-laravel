<?php

namespace Square1\Laravel\Resized;

use Square1\Resized\Resized;
use Illuminate\Support\ServiceProvider;

class ResizedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = dirname(__DIR__).'/config/resized.php';

        $this->package($source, 'resized');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('resized', function () {
            $resizer = new Resized(\Config::get('resized.key'), \Config::get('resized.secret'));
            $resizer->setHost(\Config::get('resized.host'));
            $resizer->setDefaultImage(\Config::get('resized.default'));

            return $resizer;
        });
    }
}
