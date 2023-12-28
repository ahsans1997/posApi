<?php

use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('subcategories', SubCategoryController::class);
Route::post('subcategories/{subCategory}/restore', [SubCategoryController::class, 'restore']);
Route::post('subcategories/{subCategory}/force-delete', [SubCategoryController::class, 'forceDelete']);
Route::post('subcategories/isActive', [SubCategoryController::class, 'isActive']);
