<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Movie::all();
        return Movie::where('status', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $request)
    {
        Movie::create($request->validated());
        return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        $movie->update($request->validated());
        return response()->json($movie, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }
}
