<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Models\Movie;
use App\Models\Genre;
use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $movies = Movie::all();

        return view('movies.index', compact('movies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $genres = Genre::All();
        return view('movies.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        if (isset($fields['image'])) {
            // $fields['link'] = $request->image->storePublicly('movies', 'local');
            $fields['link'] = $request->image->storePublicly('movies', 'public');
        }

        $movie = Movie::create($fields);
        $movie->genres()->sync($fields['genres']);

        return redirect()->route('movies.index')
            ->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): View
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie): View
    {
        $genres = Genre::All();
        return view('movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, Movie $movie): RedirectResponse
    {
        $fields = $request->validated();

        $movie->update($fields);
        $movie->genres()->sync($fields['genres']);

        return redirect()->route('movies.index')
            ->with('success', 'Movie updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie): RedirectResponse
    {
        $fs = Storage::disk('public');

        if (!is_null($movie->link) && $fs->exists($movie->link)) {
            $fs->delete($movie->link);
        }

        $movie->delete();

        return redirect()->route('movies.index')
            ->with('success', 'Movie deleted successfully');
    }
}
