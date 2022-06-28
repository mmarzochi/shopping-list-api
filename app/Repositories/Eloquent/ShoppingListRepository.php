<?php

namespace App\Repositories\Eloquent;

use App\Models\ShoppingList;
use App\Repositories\Contracts\ShoppingListRepositoryInterface;

class ShoppingListRepository extends AbstractRepository implements ShoppingListRepositoryInterface
{
    protected $model = ShoppingList::class;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function getById(Int $id)
    {
        return $this->model->with('products')->findOrFail($id);
    }

    public function clone(Int $id)
    {
        $record = $this->getById($id)->replicate();
        $record->save();

        foreach($record->products as $products){
            $record->products()->create($products->toArray());
        }

        $record->load('products');
        return $record;
    }
}