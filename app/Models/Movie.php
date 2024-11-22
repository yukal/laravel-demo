<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
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
}
