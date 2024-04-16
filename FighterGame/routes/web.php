<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CharacterController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/characters', [CharacterController::class, 'index'])->middleware('auth');

Auth::routes();


