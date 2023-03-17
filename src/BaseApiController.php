<?php

namespace Tungpt\Base;

use App\Http\Controllers\Controller;
use Tungpt\Base\BaseResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseApiController extends Controller
{
    use BaseResponse;
    protected $service;

    abstract function __construct();

    public function destroy($id)
    {
        $result = $this->service->destroy($id);
        return $this->baseResponse($result);
    }

    public function getList(Request $request)
    {
        $data = $this->service->getList($request);
        return $this->success($data);
    }

    public function show($id)
    {
        $result = $this->service->show($id);
        return $this->success($result);
    }

    public function index(Request $request)
    {
        $result = $this->service->index($request);
        return $this->success($result);
    }

    public function create(Request $request)
    {
        $result = $this->service->create($request);
        return $this->baseResponse($result);
    }

    public function update($id, Request $request)
    {
        $result = $this->service->update($id, $request);
        return $this->baseResponse($result);
    }
}

