<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BooksController;
use App\Http\Controllers\API\BorrowController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\RolesController;

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

Route::prefix('v1')->group(function () {
    Route::apiResource('category', CategoriesController::class);
    Route::apiResource('books', BooksController::class);
    Route::apiResource('role', RolesController::class);

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    
    });

    Route::get('/me', [AuthController::class, 'getUser'])->middleware('auth:api');
    Route::post('profile', [ProfileController::class, 'store'])->middleware('auth:api');
    Route::get('/get-profile', [ProfileController::class, 'index'])->middleware('auth:api');
    Route::post('/borrow', [BorrowController::class, 'store'])->middleware('auth:api');
    Route::get('/borrow', [BorrowController::class, 'index']);
    Route::post('/borrow/delete/{id}', [BorrowController::class, 'delete']);

});

