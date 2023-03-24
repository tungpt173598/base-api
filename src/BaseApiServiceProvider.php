<?php

namespace Tungpt\Base;

use Illuminate\Support\ServiceProvider;
use Tungpt\Base\TControllerMakeCommand;
use Tungpt\Base\RepositoryMakeCommand;
use Tungpt\Base\ServiceMakeCommand;

class BaseApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TControllerMakeCommand::class,
                ServiceMakeCommand::class,
                RepositoryMakeCommand::class
            ]);
        }
    }

    public function boot()
    {

    }
}
