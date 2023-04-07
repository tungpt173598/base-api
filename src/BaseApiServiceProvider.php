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
        $this->publishes([
            __DIR__.'/BaseResponse.php' => app()->getNameSpace() . '\Traits\BaseResponse.php',
        ], 'base-response');
        $this->publishes([
            __DIR__.'/BaseApiController.php' => app()->getNameSpace() . '\Http\Controllers\Api\BaseApiController.php',
        ], 'base-controller');
        $this->publishes([
            __DIR__.'/BaseService.php' => app()->getNameSpace() . '\Services\BaseService.php',
        ], 'base-service');
        $this->publishes([
            __DIR__.'/BaseRepository.php' => app()->getNameSpace() . '\Repositories\BaseRepository.php',
        ], 'base-repository');
    }
}
