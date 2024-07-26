<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [LoginController::class, 'login'])->name('login'); // '/api/login'

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [UserController::class, 'index']); // /api/users?page=2
    Route::get('/users/{user}', [UserController::class, 'show']); // /api/users/1
    Route::post('/users', [UserController::class, 'store']); // /api/users
    Route::put('/users/{user}', [UserController::class, 'update']); // /api/users/1
    Route::delete('/users/{user}', [UserController::class, 'destroy']); // /api/users/1

    Route::get('/bills', [BillController::class, 'index']); // /api/bills?page=2
    Route::get('/bills/{bill}', [BillController::class, 'show']); // /api/bills/1
    Route::post('/bills', [BillController::class, 'store']); // /api/bills
    Route::put('/bills/{bill}', [BillController::class, 'update']); // /api/bills/1
    Route::delete('/bills/{bill}', [BillController::class, 'destroy']); // /api/bills/1

    Route::post('/logout', [LoginController::class, 'logout']); // '/api/logout'
});


