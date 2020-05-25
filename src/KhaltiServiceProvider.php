<?php

namespace AsDh;

use Illuminate\Support\ServiceProvider;

class KhaltiServiceProvider extends ServiceProvider
{
    /**
     * Publishes configuration file.
     *
     * @return  void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../config/khalti.php' => config_path('khalti.php'),
            ],
            'khalti'
        );
    }

    /**
     * Make config publishment optional by merging the config from the package.
     *
     * @return  void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/khalti.php',
            'khalti'
        );
    }
}
