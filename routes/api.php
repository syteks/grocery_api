<?php

use App\Http\Controllers\GroceryListController;
use App\Http\Controllers\GroceryListItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => [
        'user.token.verify',
    ],
], static function (): void {
    /*
    |--------------------------------------------------------------------------
    | The calls that will manipulate the user's resource.
    |--------------------------------------------------------------------------
    */

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store'])->withoutMiddleware(['user.token.verify']);
    Route::match(['put', 'patch'], '/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | The calls that will manipulate the user's grocery list.
    |--------------------------------------------------------------------------
    */

    Route::get('/grocery-lists', [GroceryListController::class, 'index']);
    Route::get('/grocery-lists/{grocery_list}', [GroceryListController::class, 'show']);
    Route::post('/grocery-lists', [GroceryListController::class, 'store']);
    Route::match(['put', 'patch'], '/grocery-lists/{grocery_list}', [GroceryListController::class, 'update']);
    Route::delete('/grocery-lists/{grocery_list}', [GroceryListController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | The calls that will manipulate the grocery list's items resource.
    |--------------------------------------------------------------------------
    */

    Route::get('/grocery-lists/{grocery_list}/items/{grocery_list_item}', [GroceryListItemController::class, 'show']);
    Route::post('/grocery-lists/{grocery_list}/items/{item?}', [GroceryListItemController::class, 'store']);
    Route::match(['put', 'patch'], '/grocery-lists/{grocery_list}/items/{grocery_list_item}', [GroceryListItemController::class, 'update']);
    Route::delete('/grocery-lists/{grocery_list}/items/{grocery_list_item}', [GroceryListItemController::class, 'destroy']);
});
