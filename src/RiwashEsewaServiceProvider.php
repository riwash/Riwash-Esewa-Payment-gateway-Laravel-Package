<?php
namespace Riwash\Esewa;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
class RiwashEsewaServiceProvider extends ServiceProvider
{
	public function boot()
    {
        $this->loadRoutesFrom(__DIR__ .'/routes/web.php');

	}
	public function register()
    {

	}

}

?>