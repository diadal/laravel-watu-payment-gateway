<?php

namespace Diadal\Watu;

use Illuminate\Support\ServiceProvider;

class WatuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/watu.php' => config_path('watu.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/watu.php',
            'watu'
        );
    }
}
