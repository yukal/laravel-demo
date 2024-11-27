<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;

class Movie extends Model
{
    const UNPUBLISHED = 0;
    const PUBLISHED = 1;

    protected $fillable = [
        'name',
        'link',
        'status',
    ];

    public $timestamps = false;

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genres_movies');
    }

    public function mappedGenres(Collection $genres) {
        $data = [];

        foreach ($this->genres as $genre) {
            $data[$genre->id] = $genre->name;
        }

        return $data;
    }

    public static function getStatuses(): array
    {
        return [
            self::UNPUBLISHED => 'unpublished',
            self::PUBLISHED => 'published',
        ];
    }

    public function getStatusAttribute($value)
    {
        return match ($value) {
            self::UNPUBLISHED => 'unpublished',
            self::PUBLISHED => 'published',
            default => 'unknown',
        };
    }

    public function getGenresNamesAttribute(): string
    {
        $genresNames = [];

        foreach ($this->genres as $genre) {
            $genresNames[] = $genre->name;
        }

        return implode(', ', $genresNames);
    }

    public function getExistImageAttribute(): bool
    {
        $publicPath = public_path('storage/');

        return (!is_null($this->link) || $this->link != '')
            && file_exists($publicPath.$this->link);
    }
}
