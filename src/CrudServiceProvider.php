<?php

namespace Amorim\Crud;

use Illuminate\Support\ServiceProvider;


class CrudServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        //Views
        $this->loadViewsFrom(__DIR__.'/views', 'crud'); //return view(crud::index”);
        $this->publishes([__DIR__.'/views' => resource_path('views/mjvamorim/crud'),],'views');
        

        //Migrations
        //$this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([__DIR__.'/example/migrations' => database_path('migrations/'),],'migrations');

        //Config
        $this->publishes([__DIR__.'/config/crud.php' => config_path('crud.php'), ],'config');
    }

    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Amorim\Crud\Controllers\CrudController');
    }

}
