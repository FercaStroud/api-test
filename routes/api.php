<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthJWTController;

//JWT
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth-jwt'
], function ($router) {
    Route::post('login', [AuthJWTController::class, 'login']);
    Route::post('logout', [AuthJWTController::class, 'logout']);
    Route::post('refresh', [AuthJWTController::class, 'refresh']);
    Route::post('me', [AuthJWTController::class, 'me']);
    Route::post('register', [AuthJWTController::class, 'register']);
});

//Sanctum
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

    Route::post('/books/{book}/add-to-user/{user}', [BookController::class, 'addToUser']);
    Route::post('/categories/{category}/add-to-book/{book}', [CategoryController::class, 'addToBook']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('/auth-jwt/logout', [AuthJWTController::class, 'logout']);

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

    Route::post('/books/{book}/add-to-user/{user}', [BookController::class, 'addToUser']);
    Route::post('/categories/{category}/add-to-book/{book}', [CategoryController::class, 'addToBook']);
});
