<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getAll();
    public function getById(Int $id);
    public function store(Array $data);
    public function update(Int $id, Array $data);
    public function destroy(Int $id);
}

