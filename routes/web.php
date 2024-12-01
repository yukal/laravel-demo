<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');
Route::get('/genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
Route::put('/genres/{genre}', [GenreController::class, 'update'])->name('genres.update');
Route::delete('/genres/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
Route::patch('/movies/{movie}', [MovieController::class, 'publish'])->name('movies.publish');
Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
