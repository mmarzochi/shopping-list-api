<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me'])->name('login');
});

Route::prefix('shopping-lists')->group(function () {
    Route::get('/', [ShoppingListController::class, 'index'])->name('shoppingList.index');
    Route::get('/{id}', [ShoppingListController::class, 'show'])->name('shoppingList.show');

    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::post('/', [ShoppingListController::class, 'store'])->name('shoppingList.store');
        Route::post('/{id}/clone', [ShoppingListController::class, 'clone'])->name('shoppingList.clone');
        Route::put('/{id}', [ShoppingListController::class, 'update'])->name('shoppingList.update');
        Route::delete('/{id}', [ShoppingListController::class, 'destroy'])->name('shoppingList.delete');
    });
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::put('/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    });
});

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});