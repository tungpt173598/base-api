<?php

namespace Tungpt\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract function getModel();

    public function find($id, $relations = [])
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function getParams($request)
    {
        $fillable = $this->getFillable();
        return $request->only($fillable);
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }

    public function create($request)
    {
        $params = $this->getParams($request);
        return $this->model->create($params);
    }

    public function update($id, $request)
    {
        $params = $this->getParams($request);
        $object = $this->model->findOrFail($id);
        foreach ($params as $key => $value) {
            $object->{$key} = $value;
        }
        $object->save();
        return $object;
    }

    public function getTotalRow($query)
    {
        return DB::table(DB::raw("({$query->toSql()}) as count"))
            ->mergeBindings($query->getQuery())
            ->get()
            ->count();
    }

    /**
     * @method formatItems
     * Overwrite this method to modify data
     * @param $items
     * @return mixed*/
    final function formatItems($items)
    {
        return $items;
    }

    public function basePaginate($query, $request, $format = 'formatItems')
    {
        $page = isset($request->page) ? intval($request->page) : Consts::BASE_PAGE;
        $perPage = isset($request->size) ? intval($request->size) : Consts::BASE_PAGE_SIZE;
        $skip = $page === 1 ? 0 : ($perPage * ($page - 1));
        $totalRow = $this->getTotalRow($query);
        $totalPage = ceil($totalRow / $perPage);
        $items = $query->skip($skip)->take($perPage)->get();
        $items = $this->{$format}($items);
        return [
            'records' => $items,
            'totalRow' => $totalRow,
            'totalPage' => $totalPage,
            'currentPage' => $page,
            'limitFrom' => count($items) ? $skip + 1 : 0,
            'limitTo' => $skip + count($items)
        ];
    }

    public function index($request, $fieldOrderBy = 'created_at', $typeOrderBy = 'DESC')
    {
        $table = $this->model->getTable();

        return $this->basePaginate($this->model->orderBy("{$table}.{$fieldOrderBy}", "{$typeOrderBy}"), $request);
    }

    public function insert($datas)
    {
        return $this->model->insert($datas);
    }

    public function delete($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
