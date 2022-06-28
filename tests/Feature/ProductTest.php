<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductTest extends TestCase
{
    
    public function testRequiredFieldsForProductCreation(){

        $token =  Auth::login(User::first(), true);

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', 'api/products', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "shopping_list_id" => ["The shopping list id field is required."],
                "name" => ["The name field is required."],
                "qty" => ["The qty field is required."]
            ]);
    }

    public function testSuccessfulProductCreating(){
        
        $token =  Auth::login(User::first(), true);
        $shoppingList = ShoppingList::create(['name' => 'Test Shopping List - Product Test']);

        $product = [
            "shopping_list_id" => $shoppingList->id, 
            "name" => "Test Product", 
            "qty" => 5,
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', 'api/products', $product, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'shopping_list_id',
                'name',
                'qty',
                'updated_at',
                'created_at',
            ]);
    }

    public function testSuccessfulProductUpdate(){

        $token =  Auth::login(User::first(), true);

        $getProduct = Product::latest()->first();

        $updateInfo = [
            "shopping_list_id" => $getProduct->shopping_list_id, 
            "name" => "Test Product 2", 
            "qty" => 2,
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('PUT', "api/products/{$getProduct->id}", $updateInfo, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'shopping_list_id',
                'name',
                'qty',
                'updated_at',
                'created_at',
            ]);
    }

    public function testSuccessfulProductUpdateQty(){

        $token =  Auth::login(User::first(), true);

        $getProduct = Product::latest()->first();

        $updateInfo = [
            "qty" => 5
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('PATCH', "api/products/{$getProduct->id}", $updateInfo, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'shopping_list_id',
                'name',
                'qty',
                'updated_at',
                'created_at',
            ]);
    }

    public function testSuccessfulDeletation(){

        $token =  Auth::login(User::first(), true);

        $getProduct = Product::latest()->first();

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('DELETE', "api/products/{$getProduct->id}", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "deleted" => true
            ]);
    }

    public function testUnSuccessfulDeletation(){

        $token =  Auth::login(User::first(), true);

        $productId = 100; // It Doesn't exist

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('DELETE', "api/products/{$productId}", ['Accept' => 'application/json'])
            ->assertStatus(404)
            ->assertJson([
                "message" => "No query results for model [App\\Models\\Product] {$productId}"
            ]);
    }
}
