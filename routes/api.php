<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('categories', CategoryController::class);
Route::post('categories/forceDelete/{id}', [CategoryController::class, 'forceDelete']);
Route::post('categories/restore/{id}', [CategoryController::class, 'restore']);
Route::post('categories/is_active/{id}', [CategoryController::class, 'is_active']);
Route::post('categories/is_featured/{id}', [CategoryController::class, 'is_featured']);
Route::post('categories/is_trending/{id}', [CategoryController::class, 'is_trending']);
