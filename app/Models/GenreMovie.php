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
    protected $table = 'genre_movie';

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
