<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/test', [UserController::class, 'index']);

// Login route
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('/product')->group(function () {
        Route::get('/show/{id}', [ProductController::class, 'show'])->middleware('can:show product');
        Route::get('/showAll', [ProductController::class, 'showAll'])->middleware('can:show product');
        Route::post('/create', [ProductController::class, 'create'])->middleware('can:create product');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->middleware('can:delete product');
    });
});
