<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuItemController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('menu-items', MenuItemController::class);
Route::get('menu-items/category/{category}', [MenuItemController::class, 'byCategory']);
