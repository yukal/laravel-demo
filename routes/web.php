<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/icons', fn () => 
    Inertia::render('Icons'))->name('icons');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('genres', GenreController::class);

// Route::get('/movies/unpublished', [MovieController::class, 'unpublished'])->name('movies.unpublished');
Route::patch('/movies/{movie}/publicity', [MovieController::class, 'publicity'])->name('movies.publicity');
Route::get('/preview', [MovieController::class, 'preview'])->name('movies.preview');
Route::resource('movies', MovieController::class);

require __DIR__.'/auth.php';
