<?php

use App\Http\Controllers\StaticController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StaticController::class, 'home'])->name('root'); //This is a test route. Will be removed in production.
