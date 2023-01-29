<?php

declare(strict_types=1);

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BouncerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login'])->name('passport.login');
        Route::post('register', [AuthController::class, 'register'])->name('passport.register');
    });

Route::resource('servers', ServerController::class)->only('index', 'show');
Route::resource('services', ServiceController::class)->only('index', 'show');
Route::resource('posts', PostController::class)->only('index', 'show');
Route::resource('images', ImageController::class)->only('show');
