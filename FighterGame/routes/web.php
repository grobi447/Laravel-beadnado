<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PlaceController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/characters', [CharacterController::class, 'index'])->name('characters')->middleware('auth');
Route::get('/characters/create', [CharacterController::class, 'create'])->name('characters.create')->middleware('auth');
Route::post('/characters/create', [CharacterController::class, 'store'])->name('characters.store')->middleware('auth');
Route::get('/characters/{id}', [CharacterController::class, 'show'])->name('characters.show')->middleware('auth');
Route::get('/characters/{id}/edit', [CharacterController::class, 'edit'])->name('characters.edit')->middleware('auth');
Route::put('/characters/{id}/edit', [CharacterController::class, 'update'])->name('characters.update')->middleware('auth');
Route::get('/characters/{id}/delete', [CharacterController::class, 'destroy'])->name('characters.delete')->middleware('auth');

Route::get('match/create', [ContestController::class, 'create'])->name('matches.create')->middleware('auth');
Route::post('match/create', [ContestController::class, 'store'])->name('matches.store')->middleware('auth');
Route::get('match/{id}', [ContestController::class, 'show'])->name('matches.show')->middleware('auth');



Route::get('places', [PlaceController::class, 'index'])->name('places.index')->middleware('auth');
Route::get('places/create', [PlaceController::class, 'create'])->name('places.create')->middleware('auth');
Route::post('places/create', [PlaceController::class, 'store'])->name('places.store')->middleware('auth');
Route::get('places/{id}/edit', [PlaceController::class, 'edit'])->name('places.edit')->middleware('auth');
Route::put('places/{id}/edit', [PlaceController::class, 'update'])->name('places.update')->middleware('auth');
Route::get('places/{id}/delete', [PlaceController::class, 'destroy'])->name('places.delete')->middleware('auth');
Auth::routes();


