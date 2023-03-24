# Tungpt/base-api
This package help you create a base API Laravel app with repository pattern
# install:
```bass
composer require tungpt/base-api:dev-main
```
# commands provided
Make a API Controller
```bass
php artisan make:tcontroller ControllerName
```
```bass
<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tungpt\Base\BaseApiController;

class ControllerName extends BaseApiController
{
    /**
    * Construct example
    *
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    */

    public function __construct()
    {
        // Inject service here
    }
}
```
Make a Repository
```bass
php artisan make:repository RepositoryName
```
```bass
<?php

namespace App\Repositories;

use Tungpt\Base\BaseRepository;

class RepositoryName extends BaseRepository
{
    public function getModel()
    {
        // Return model instance here
        // return new Model();
    }
}
```
Make a Service
```bass
php artisan make:service ServiceName
```
```bass
<?php

namespace App\Services;

use Tungpt\Base\BaseService;

class ServiceName extends BaseService
{
    /**
    * Construct example
    *
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }
    */
    public function __construct()
    {
        // Inject repository here
    }
}
```
# License
MIT License. [Read here](https://github.com/tungpt173598/base-api/blob/main/LICENSE)
