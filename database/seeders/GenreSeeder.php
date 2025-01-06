<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // https://boords.com/blog/100-movie-genres-the-definitive-list-with-examples

        Genre::factory()->createMany([
            ['name' => 'Action'],
            ['name' => 'Thriller'],
            ['name' => 'Drama'],
            ['name' => 'Comedy'],
            ['name' => 'Romance'],
            ['name' => 'Horror'],
            ['name' => 'Western'],
            ['name' => 'Crime'],
            ['name' => 'Fantasy'],
            // ['name' => 'Mystery'],
            // ['name' => 'Historical'],
            // ['name' => 'Musical'],
            // ['name' => 'Animation'],
            // ['name' => 'Documentary'],
            // ['name' => 'Adventure'],
            // ['name' => 'Science'],
        ]);
    }
}
