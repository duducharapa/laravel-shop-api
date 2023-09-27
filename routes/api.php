<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->apiResource('products', ProductController::class);

Route::middleware('auth:sanctum')->prefix('cart')->controller(CartController::class)->group(function () {
    Route::get('/', 'index');

    Route::prefix('items')->group(function () {
        Route::post('/', 'create');
        Route::patch('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});

Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::post('users', [UserController::class, 'store']);