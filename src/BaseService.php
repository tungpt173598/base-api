<?php

namespace Tungpt\Base;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Tungpt\Base\BaseRepository;

abstract class BaseService
{
    protected $repository;

    abstract function __construct();
    public function index($request)
    {
        $result = $this->repository->index($request);
        return $this->success($result);
    }

    protected function create($request)
    {
        try {
            $result = $this->repository->create($request);
            return $this->success($result);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    protected function update($id, $request)
    {
        try {
            $result = $this->repository->update($id, $request);
            return $this->success($result);
        } catch (\Exception $e) {
            return $this->error();
        }
    }
    protected function delete($id)
    {
        try {
            $this->repository->delete($id);
            return $this->success();
        } catch (\Exception $e) {
            return $this->error();
        }

    }

    public function show($id)
    {
        $result = $this->repository->find($id);
        return $this->success($result);
    }

    protected function success($data = [])
    {
        return [
            'status' => Response::HTTP_OK,
            'messages' => ['Success'],
            'data' => $data
        ];
    }

    protected function error($messages = ['Server Error'], $data = [])
    {
        return [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'messages' => $messages,
            'data' => $data
        ];
    }

    protected function notFound($messages = ['Not Found'])
    {
        return [
            'status' => Response::HTTP_NOT_FOUND,
            'messages' => $messages,
        ];
    }

    protected function notAllowed($messages = ['Not Allowed'])
    {
        return [
            'status' => Response::HTTP_FORBIDDEN,
            'messages' => $messages
        ];
    }

}