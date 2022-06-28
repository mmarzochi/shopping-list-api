<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ShoppingListTest extends TestCase
{

    public function testRequiredFieldsForShoppingListCreation()
    {
        $token =  Auth::login(User::first(), true);
       
        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', 'api/shopping-lists', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "name" => ["The name field is required."]
        ]);
    }

    public function testSuccessfulShoppingListCreating(){

        $token =  Auth::login(User::first(), true);

        $shoppingList = [
            "name" => "Test Shopping List", 
            "is_active" => 1
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', 'api/shopping-lists', $shoppingList, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'created_at',
                'updated_at'
            ]);
    }

    public function testSuccessfulShoppingListUpdate(){

        $token =  Auth::login(User::first(), true);

        $shoppingList = ShoppingList::latest()->first();

        $updateInfo = [
            "name" => "Test Shopping List 2"
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('PUT', "api/shopping-lists/{$shoppingList->id}", $updateInfo, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'updated_at',
                'created_at',
            ]);
    }

    public function testSuccessfulDeletation(){

        $token =  Auth::login(User::first(), true);

        $shoppingList = ShoppingList::latest()->first();

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('DELETE', "api/shopping-lists/{$shoppingList->id}", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "deleted" => true
            ]);
    }

    public function testUnSuccessfulDeletation(){

        $token =  Auth::login(User::first(), true);

        $shoppingListId = 100; // It Doesn't exist

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('DELETE', "api/shopping-lists/{$shoppingListId}", ['Accept' => 'application/json'])
            ->assertStatus(404)
            ->assertJson([
                "message" => "No query results for model [App\\Models\\ShoppingList] {$shoppingListId}"
            ]);
    }
}
