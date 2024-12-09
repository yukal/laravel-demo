<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Movie;
use App\Models\Genre;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Requests\PublicityMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        // $movies = Movie::where('published', 1)
        //     ->orderBy('id', 'desc')
        //     ->paginate(10);

        $movies = Movie::orderBy('id', 'desc')
            ->paginate(10);

        return Inertia::render('Movies/Index', [
            'movies' => $movies,
            'statuses' => Movie::getStatuses(),
            'i' => ($request->input('page', 1) - 1) * $movies->perPage(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    // public function unpublished(Request $request): Response
    // {
    //     $movies = Movie::where('published', 0)
    //         ->orderBy('id', 'desc')
    //         ->paginate(10);

    //     return Inertia::render('Movies/Index', [
    //         'movies' => $movies,
    //         'statuses' => Movie::getStatuses(),
    //         'i' => ($request->input('page', 1) - 1) * $movies->perPage(),
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Movies/Create', [
            'genres' => Genre::All(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        if ($request->hasFile('poster') && isset($fields['poster'])) {
            $fields['poster'] = $request->poster->storePublicly('movies', 'public');
        }

        $movie = Movie::create($fields);
        $movie->genres()->sync($fields['genres']);

        return redirect()->route('movies.index')
            ->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): Response
    {
        return Inertia::render('Movies/Show', [
            'movie' => $movie->load(['genres']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie): Response
    {
        return Inertia::render('Movies/Edit', [
            'movie' => $movie->append([
                'genresIDs',
            ]),
            'genres' => Genre::All(),
            'statuses' => Movie::getStatuses(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie): RedirectResponse
    {
        $fields = $request->validated();
        // dd($fields);

        if (isset($fields['poster'])) {
            if ($movie->posterExist) {
                Storage::disk('public')->delete($movie->poster);
            }

            $fields['poster'] = $request->file('poster')
                ->storePublicly('movies', 'public');
        }

        if (count($fields) > 0) {
            $movie->update($fields);

            if (isset($fields['genres'])) {
                $movie->genres()->sync($fields['genres']);
            }
        }

        return redirect()
            // ->back()
            ->route('movies.index')
            ->with('success', 'Movie updated successfully');
    }

    /**
     * Set movie publicity [true|false].
     */
    public function publicity(PublicityMovieRequest $request, Movie $movie): RedirectResponse
    {
        $movie->update($request->validated());
        $msg = $request->published 
            ? 'Movie published successfully'
            : 'Movie unpublished successfully';

        return redirect()
            ->back()
            // ->route('movies.index')
            ->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie): RedirectResponse
    {
        $fs = Storage::disk('public');

        if (!empty($movie->poster) && $fs->exists($movie->poster)) {
            $fs->delete($movie->poster);
        }

        $movie->delete();

        return redirect()
            // ->route('movies.index')
            ->back()
            ->with('success', 'Movie deleted successfully');
    }
}
