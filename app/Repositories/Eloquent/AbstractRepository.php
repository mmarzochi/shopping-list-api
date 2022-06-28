<?php

namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{
    const PAGINATION = 25;

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function resolveModel()
    {
        return app($this->model);
    }

    public function getAll()
    {
        return $this->model->paginate(self::PAGINATION);
    }

    public function getById(Int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function store(Array $data)
    {
        return $this->model->create($data);
    }

    public function update(Int $id, Array $data)
    {
        $record = $this->getById($id);
        $record->update($data);
        return $record;
    }

    public function destroy(Int $id)
    {
        return $this->model->destroy($id);
    }
}