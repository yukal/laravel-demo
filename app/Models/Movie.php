<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\GenreMovie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    const UNPUBLISHED = false;
    const PUBLISHED = true;

    protected $hidden = ['pivot'];
    protected $fillable = [
        'name',
        'poster',
        'published',
    ];

    protected $appends = [
        'publishedText',
    ];

    public $timestamps = false;

    public static function getStatuses(): array
    {
        return [
            self::UNPUBLISHED => 'unpublished',
            self::PUBLISHED => 'published',
        ];
    }

    /**
     * The genres that belongs to the movie.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
            // ->using(GenreMovie::class);
            // ->withPivot(['genre_id', 'movie_id']);
    }

    public function getGenresMapAttribute(): array
    {
        return $this->genres()
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getGenresIDsAttribute(): array
    {
        return $this->genres()
            ->pluck('id')
            ->toArray();
    }

    public function getPublishedTextAttribute(): string
    {
        return match ($this->published) {
            self::UNPUBLISHED => 'unpublished',
            self::PUBLISHED => 'published',
            default => 'unknown',
        };
    }

    public function getPosterExistAttribute(): bool
    {
        return !empty($this->poster) 
            && Storage::disk('public')->exists($this->poster);
    }
}
