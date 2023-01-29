<?php
//This is the tenant based auth group

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BouncerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'auth'], function (){
    Route::get('logout', [AuthController::class, 'logout'])->name('passport.logout');
    Route::get('profile', [AuthController::class, 'profile'])->name('passport.profile');
});

Route::apiResource('users', UserController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('servers', ServerController::class)->except('index', 'show', 'store');
Route::post('/servers/{user}', [ServerController::class, 'store'])->name('servers.store');
Route::apiResource('services', ServiceController::class)->except('index', 'show');
Route::apiResource('posts', PostController::class)->except('index', 'show');
Route::apiResource('images', ImageController::class)->except('show', 'store', 'update');
Route::post('/assign/{user}/{role:name}', [BouncerController::class, 'assign_role']);
Route::delete('/unassign/{user}/{role:name}', [BouncerController::class, 'remove_role']);
