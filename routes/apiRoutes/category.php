<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class);
Route::post('categories/forceDelete/{id}', [CategoryController::class, 'forceDelete']);
Route::post('categories/restore/{id}', [CategoryController::class, 'restore']);
Route::post('categories/is_active/{id}', [CategoryController::class, 'is_active']);
Route::post('categories/is_featured/{id}', [CategoryController::class, 'is_featured']);
Route::post('categories/is_trending/{id}', [CategoryController::class, 'is_trending']);
