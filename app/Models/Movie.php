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
        'link',
        'status',
    ];

    protected $appends = [
        'status_text',
        'exist_image',
        'genres_names',
        'genres_ids',
    ];

    public $timestamps = false;

    /**
     * The genres that belongs to the movie.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id')
            ->using(GenreMovie::class);
            // ->withPivot(['genre_id', 'movie_id']);
    }

    public static function getStatuses(): array
    {
        return [
            self::UNPUBLISHED => 'unpublished',
            self::PUBLISHED => 'published',
        ];
    }

    public function getGenresIDsAttribute(): array
    {
        return $this->genres()
            ->pluck('id', 'id')
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
        return match ($this->status) {
            self::UNPUBLISHED => 'unpublished',
            self::PUBLISHED => 'published',
            default => 'unknown',
        };
    }

    public function getExistImageAttribute(): bool
    {
        return !empty($this->link) 
            && Storage::disk('public')->exists($this->link);
    }
}
