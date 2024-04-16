<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ContestController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/characters', [CharacterController::class, 'index'])->name('characters')->middleware('auth');
Route::get('/characters/{id}', [CharacterController::class, 'show'])->name('characters.show')->middleware('auth');
Route::get('/characters/{id}/edit', [CharacterController::class, 'edit'])->name('characters.edit')->middleware('auth');
Route::get('/characters/{id}/delete', [CharacterController::class, 'destroy'])->name('characters.delete')->middleware('auth');

Route::get('characters/{id}/match', [ContestController::class, 'show'])->name('matches.show')->middleware('auth');
Route::get('characters/{id}/creatematch', [ContestController::class, 'create'])->name('matches.create')->middleware('auth');

Auth::routes();


