<?php

use App\Http\Controllers\Api\V1\GenreController;
use App\Http\Controllers\Api\V1\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API v1

Route::get('/v1/genres', [GenreController::class, 'index'])->name('api1.genres.index');
Route::post('/v1/genres', [GenreController::class, 'store'])->name('api1.genres.store');
Route::get('/v1/genres/{genre}', [GenreController::class, 'show'])->name('api1.genres.show');
Route::put('/v1/genres/{genre}', [GenreController::class, 'update'])->name('api1.genres.update');
Route::delete('/v1/genres/{genre}', [GenreController::class, 'destroy'])->name('api1.genres.destroy');

Route::get('/v1/movies', [MovieController::class, 'index'])->name('api1.movies.index');
Route::post('/v1/movies', [MovieController::class, 'store'])->name('api1.movies.store');
Route::get('/v1/movies/{movie}', [MovieController::class, 'show'])->name('api1.movies.show');
Route::put('/v1/movies/{movie}', [MovieController::class, 'update'])->name('api1.movies.update');
Route::delete('/v1/movies/{movie}', [MovieController::class, 'destroy'])->name('api1.movies.destroy');
