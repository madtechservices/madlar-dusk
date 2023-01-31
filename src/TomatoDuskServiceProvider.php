<?php

namespace TomatoPHP\TomatoDusk;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoDusk\Console\TestGeneratorCommand;
use TomatoPHP\TomatoDusk\Console\TomatoDuskRun;
use TomatoPHP\TomatoDusk\Menus\TestLogMenu;
use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenuRegister;


class TomatoDuskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoDusk\Console\TomatoDuskInstall::class,
            TestGeneratorCommand::class,
            TomatoDuskRun::class
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-dusk.php', 'tomato-dusk');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-dusk.php' => config_path('tomato-dusk.php'),
        ], 'config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-dusk');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-dusk'),
        ], 'views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-dusk');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => resource_path('lang/vendor/tomato-dusk'),
        ], 'lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        TomatoMenuRegister::registerMenu(TestLogMenu::class);

    }

    public function boot(): void
    {
        //you boot methods here
    }
}