<?php

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


// All routes that require for category
require __DIR__ . '/apiRoutes/category.php';

// All routes that require for subcategory
require __DIR__ . '/apiRoutes/subcategory.php';
