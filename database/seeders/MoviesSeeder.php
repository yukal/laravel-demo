<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            // 1. Action
            [
                'id' => 1,
                'name' => 'Gladiator',
                'link' => 'https://www.imdb.com/title/tt0172495/',
                'status' => true,
            ],
            [
                'id' => 2,
                'name' => 'Gladiator 2',
                'link' => 'https://www.imdb.com/title/tt9218128/',
                'status' => true,
            ],

            // 2. Thriller
            [
                'id' => 3,
                'name' => 'Killer Heat',
                'link' => 'https://www.imdb.com/title/tt27419292/',
                'status' => true,
            ],

            // 3. Drama
            [
                'id' => 4,
                'name' => 'Skin',
                'link' => 'https://www.imdb.com/title/tt6043142/',
                'status' => true,
            ],
            [
                'id' => 5,
                'name' => 'Megalopolis',
                'link' => 'https://www.imdb.com/title/tt10128846/',
                'status' => true,
            ],

            // 4. Comedy
            [
                'id' => 6,
                'name' => 'The Union',
                'link' => 'https://www.imdb.com/title/tt12610390/',
                'status' => true,
            ],
            [
                'id' => 7,
                'name' => 'Mr. Bean\'s Holiday',
                'link' => 'https://www.imdb.com/title/tt0453451/',
                'status' => true,
            ],

            // 5. Romance
            [
                'id' => 8,
                'name' => 'The Lake House',
                'link' => 'https://www.imdb.com/title/tt0410297/',
                'status' => true,
            ],
            [
                'id' => 9,
                'name' => 'The Holiday',
                'link' => 'https://www.imdb.com/title/tt0457939/',
                'status' => true,
            ],
            [
                'id' => 10,
                'name' => 'The Best Christmas Pageant Ever',
                'link' => 'https://www.imdb.com/title/tt2347285/',
                'status' => true,
            ],

            // 6. Horror
            [
                'id' => 11,
                'name' => 'The Substance',
                'link' => 'https://www.imdb.com/title/tt17526714/',
                'status' => false,
            ],
            [
                'id' => 12,
                'name' => 'Alien: Romulus',
                'link' => 'https://www.imdb.com/title/tt18412256/',
                'status' => true,
            ],

            // 7. Western
            [
                'id' => 13,
                'name' => 'The Magnificent Seven',
                'link' => 'https://www.imdb.com/title/tt2404435/',
                'status' => true,
            ],
            [
                'id' => 14,
                'name' => 'Pedro Paramo',
                'link' => 'https://m.imdb.com/title/tt27717667/',
                'status' => false,
            ],
        ]);
    }
}
