<?php

namespace App\Services;

use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $relation = [])
    {
        return $this->model->with($relation)->get();
    }

    public function findByUuid(string $uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function createMultiple(array $dataArray)
    {
        foreach ($dataArray as $data) {
            $this->create($data);
        }
    }

    public function updateId(int $id, array $data)
    {
        return $this->findById($id)->update($data);
    }

    public function updateMultipleId(array $dataArray)
    {
        foreach ($dataArray as $data) {
            return $this->findById($data['id'])->update($data);
        }
    }

    public function updateUuid(string $uuid, array $data)
    {
        return $this->findByUuid($uuid)->update($data);
    }

    public function updateMultipleUuid(array $dataArray)
    {
        foreach ($dataArray as $data) {
            return $this->findByUuid($data['uuid'])->update($data);
        }
    }

    public function destroyById(int $id)
    {
        return $this->findById($id)->delete();
    }

    public function destroyMultipleId(array $ids)
    {
        foreach ($ids as $id) {
            return $this->findByUuid($id)->delete();
        }
    }

    public function destroyByUuid(string $uuid)
    {
        return $this->findByUuid($uuid)->delete();
    }

    public function destroyMultipleUuid(array $uuids)
    {
        foreach ($uuids as $uuid) {
            return $this->findByUuid($uuid)->delete();
        }
    }
}
