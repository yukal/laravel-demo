<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'genres_movies';

    protected $primaryKey = [
        'genre_id',
        'movie_id',
    ];

    protected $fillable = [
        'genre_id',
        'movie_id',
    ];

    public $timestamps = false;
}
