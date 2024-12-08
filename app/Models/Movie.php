<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\GenreMovie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    const UNPUBLISHED = 0;
    const PUBLISHED = 1;

    protected $hidden = ['pivot'];
    protected $fillable = [
        'name',
        'poster',
        'is_published',
    ];

    public $timestamps = false;

    /**
     * The genres that belongs to the movie.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    public static function getStatuses(): array
    {
        return [
            self::UNPUBLISHED => 'unpublished',
            self::PUBLISHED => 'published',
        ];
    }

    public function getGenresMapAttribute(): array
    {
        return $this->genres()
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getGenresNamesAttribute(): array
    {
        return $this->genres()
            ->pluck('name')
            ->toArray();
    }

    public function getStatusTextAttribute(): string
    {
        return match ($this->is_published) {
            self::UNPUBLISHED => 'unpublished',
            self::PUBLISHED => 'published',
            default => 'unknown',
        };
    }

    public function getExistImageAttribute(): bool
    {
        return !empty($this->poster) 
            && Storage::disk('public')->exists($this->poster);
    }
}
