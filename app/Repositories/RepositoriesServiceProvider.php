<?php
namespace App\Repositories;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\AuthInterface',
            'App\Repositories\AuthRepository'
        );
        $this->app->bind(
            'App\Repositories\UserInterface',
            'App\Repositories\UserRepository'
        );
    }
}