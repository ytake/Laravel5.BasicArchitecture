<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ConfigServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ConfigServiceProvider extends ServiceProvider
{

    /**
     *
     */
    public function register()
    {
        if ($this->app->environment("local")) {
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
        }

        config([
            //
        ]);
    }

}
