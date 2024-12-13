<?php

namespace Database\Seeders;

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

        $rows = [
            ['id' => 1, 'name' => 'Action'],
            ['id' => 2, 'name' => 'Thriller'],
            ['id' => 3, 'name' => 'Drama'],
            ['id' => 4, 'name' => 'Comedy'],
            ['id' => 5, 'name' => 'Romance'],
            ['id' => 6, 'name' => 'Horror'],
            ['id' => 7, 'name' => 'Western'],
            ['id' => 8, 'name' => 'Crime'],
            ['id' => 9, 'name' => 'Fantasy'],
            ['id' => 10, 'name' => 'Mystery'],
            ['id' => 11, 'name' => 'Historical'],
            ['id' => 12, 'name' => 'Musical'],
            ['id' => 13, 'name' => 'Animation'],
            ['id' => 14, 'name' => 'Documentary'],
            ['id' => 15, 'name' => 'Adventure'],
            ['id' => 16, 'name' => 'Science'],
        ];

        // the next ID number
        $sequence = count($rows) + 1;

        DB::table('genres')->insert($rows);
        DB::update(
            'ALTER SEQUENCE IF EXISTS public.genres_id_seq NO MINVALUE RESTART '.$sequence.' CACHE '.$sequence
        );
    }
}
