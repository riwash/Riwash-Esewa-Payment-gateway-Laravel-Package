<?php
namespace Riwash\Esewa;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
class RiwashEsewaServiceProvider extends ServiceProvider
{

	public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/riwashesewa.php', 'riwashesewa');

	}
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/riwashesewa.php' => config_path('riwashesewa.php'),
        ], 'config');


	}

}

?>