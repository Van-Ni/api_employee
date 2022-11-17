<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\User\Controllers\UserController;
use App\Modules\Company\Controllers\CompanyController;
use App\Modules\Employee\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// User
Route::controller(UserController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:api')->group(function () {

    // User
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'getCurrentUser');
        Route::post('/logout', 'logout');
    });

    // Company

    Route::controller(CompanyController::class)->prefix('company')->group(function () {
        Route::get('/', 'list');
        Route::get('/{id}', 'getById');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
        Route::delete('/destroy/multiple', 'destroy');
    });

    // Employee 

    Route::controller(EmployeeController::class)->prefix('employee')->group(function () {
        Route::get('/company/{id}', 'getByCompanyId');
        Route::get('/{id}', 'getById');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
        Route::delete('/destroy/multiple', 'destroy');
    });
});
