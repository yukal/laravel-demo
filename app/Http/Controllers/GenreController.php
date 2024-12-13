<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $genres = Genre::orderBy('id', 'desc')
            ->paginate(10);

        $i = ($request->input('page', 1) - 1) * $genres->perPage();

        // dd($genres);
        return Inertia::render('Genres/Index', [
            'genres' => $genres,
            'i' => ($request->input('page', 1) - 1) * $genres->perPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Genres/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request): RedirectResponse
    {
        Genre::create($request->validated());

        return redirect()->route('genres.index')
            ->with('success', 'Genre created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre): Response
    {
        return Inertia::render('Genres/Show', [
            'genre' => $genre,
            'movies' => $genre->movies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre): Response
    {
        return Inertia::render('Genres/Edit', [
            'genre' => $genre,
            // 'movies' => $genre->movies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre): RedirectResponse
    {
        $genre->update($request->validated());

        return redirect()->route('genres.index')
            ->with('success', 'Genre updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): RedirectResponse
    {
        $genre->delete();

        return redirect()->route('genres.index')
            ->with('success', 'Genre deleted successfully');
    }
}
