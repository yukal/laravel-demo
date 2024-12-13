<?php

namespace App\Models;

use App\Models\Movie;
use App\Models\GenreMovie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $hidden = ['pivot'];
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    /**
     * The movies that belongs to the genre.
     */
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'genre_movie', 'genre_id', 'movie_id')
            ->using(GenreMovie::class);
            // ->withPivot(['genre_id', 'movie_id']);
    }
}
