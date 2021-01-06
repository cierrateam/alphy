<?php

namespace Cierrateam\Alphy;

use Illuminate\Support\ServiceProvider;
use Livewire\LivewireTagCompiler;

class AlphyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerTagCompiler();

        $this->publishes([
            __DIR__.'/Config/alphy.php' => config_path('alphy.php'),
        ], 'alphy-config');


        //if ($this->app->runningInConsole()) {
        //    $this->commands([
        //        //
        //    ]);
        //}
    }


    protected function registerTagCompiler()
    {
        if (method_exists($this->app['blade.compiler'], 'precompiler')) {
            $this->app['blade.compiler']->precompiler(function ($string) {
                return app(AlphyTagCompiler::class)->compile($string);
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/alphy.php', 'alphy'
        );
    }
}
