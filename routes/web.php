<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('genres', GenreController::class);

Route::get('/movies/unpublished', [MovieController::class, 'unpublished'])->name('movies.unpublished');
Route::patch('/movies/{movie}/publish', [MovieController::class, 'publish'])->name('movies.publish');
Route::resource('movies', MovieController::class);
