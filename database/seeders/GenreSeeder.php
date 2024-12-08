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
        DB::table('genres')->insert([
            ['id' => 1, 'name' => 'Action'],
            ['id' => 2, 'name' => 'Thriller'],
            ['id' => 3, 'name' => 'Drama'],
            ['id' => 4, 'name' => 'Comedy'],
            ['id' => 5, 'name' => 'Romance'],
            ['id' => 6, 'name' => 'Horror'],
            ['id' => 7, 'name' => 'Western'],
        ]);
    }
}
