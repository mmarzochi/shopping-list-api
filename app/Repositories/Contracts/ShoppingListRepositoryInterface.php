<?php

namespace App\Repositories\Contracts;

interface ShoppingListRepositoryInterface
{
    public function getAll();
    public function getById(Int $id);
    public function store(Array $data);
    public function update(Int $id, Array $data);
    public function clone(Int $id);
    public function destroy(Int $id);
}

