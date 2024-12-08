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
            ['movie_id' => 1, 'genre_id' => 1],
            ['movie_id' => 2, 'genre_id' => 1],

            // 2. Thriller
            ['movie_id' => 3, 'genre_id' => 2],

            // 3. Drama
            ['movie_id' => 4, 'genre_id' => 3],
            ['movie_id' => 5, 'genre_id' => 3],

            // 4. Comedy
            ['movie_id' => 6, 'genre_id' => 4],
            ['movie_id' => 7, 'genre_id' => 4],

            // 5. Romance
            ['movie_id' => 8, 'genre_id' => 5],
            ['movie_id' => 9, 'genre_id' => 5],
            ['movie_id' => 10, 'genre_id' => 5],

            // 6. Horror
            ['movie_id' => 11, 'genre_id' => 6],
            ['movie_id' => 12, 'genre_id' => 6],

            // 7. Western
            ['movie_id' => 13, 'genre_id' => 7],
            ['movie_id' => 14, 'genre_id' => 7],
        ]);
    }
}
