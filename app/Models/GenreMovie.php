<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Movie;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GenreMovie extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'genre_movie';

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['genre', 'movie'];

    protected $primaryKey = [
        'genre_id',
        'movie_id',
    ];

    protected $fillable = [
        'genre_id',
        'movie_id',
    ];

    public $timestamps = false;

    /**
     * Get the genre for the pivot model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Get the movie for the pivot model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
