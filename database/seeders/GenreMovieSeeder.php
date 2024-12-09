<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class GenreMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genre_movie')->insert([
            // 1. Action
            ['genre_id' => 1, 'movie_id' => 1],
            ['genre_id' => 1, 'movie_id' => 2],

            // 2. Thriller
            ['genre_id' => 2, 'movie_id' => 3],

            // 3. Drama
            ['genre_id' => 3, 'movie_id' => 4],
            ['genre_id' => 3, 'movie_id' => 5],

            // 4. Comedy
            ['genre_id' => 4, 'movie_id' => 6],
            ['genre_id' => 4, 'movie_id' => 7],

            // 5. Romance
            ['genre_id' => 5, 'movie_id' => 8],
            ['genre_id' => 5, 'movie_id' => 9],
            ['genre_id' => 5, 'movie_id' => 10],

            // 6. Horror
            ['genre_id' => 6, 'movie_id' => 11],
            ['genre_id' => 6, 'movie_id' => 12],

            // 7. Western
            ['genre_id' => 7, 'movie_id' => 13],
            ['genre_id' => 7, 'movie_id' => 14],
        ]);
    }
}
