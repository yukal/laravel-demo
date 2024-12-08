<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // http://www.impawards.com/intl/

        DB::table('movies')->insert([
            // 1. Action
            [
                'id' => 1,
                'name' => 'Gladiator',
                'poster' => 'movies/MWD8GDSMRxh48WUJmcxeB0RrWpbCnCd1rMLh9MUV.jpg',
                // 'link' => 'https://www.imdb.com/title/tt0172495/',
                'is_published' => true,
            ],
            [
                'id' => 2,
                'name' => 'Gladiator 2',
                'poster' => 'movies/RTl8MRqeFkwcAyswPRWMl2Gx94DnJYIcTGUqzGcP.jpg',
                // 'link' => 'https://www.imdb.com/title/tt9218128/',
                'is_published' => true,
            ],

            // 2. Thriller
            [
                'id' => 3,
                'name' => 'Killer Heat',
                'poster' => 'movies/CQM567zAiTZY7jaiT3LcSfbe5ZhhofM5IeEMkkEG.jpg',
                // 'link' => 'https://www.imdb.com/title/tt27419292/',
                'is_published' => true,
            ],

            // 3. Drama
            [
                'id' => 4,
                'name' => 'Skin',
                'poster' => 'movies/gxGYfFakKkrBE0ztAKSQApojci2fJtVLMZVzDRI7.jpg',
                // 'link' => 'https://www.imdb.com/title/tt6043142/',
                'is_published' => true,
            ],
            [
                'id' => 5,
                'name' => 'Megalopolis',
                'poster' => 'movies/CgwXUf3ykeAw4yve0z3RZE8XrvSgxrCQTTILNtZC.jpg',
                // 'link' => 'https://www.imdb.com/title/tt10128846/',
                'is_published' => true,
            ],

            // 4. Comedy
            [
                'id' => 6,
                'name' => 'The Union',
                'poster' => 'movies/v0HSE478pCTqzykGmYtkBJ1Kx44KO4F1seJOZuO1.jpg',
                // 'link' => 'https://www.imdb.com/title/tt12610390/',
                'is_published' => true,
            ],
            [
                'id' => 7,
                'name' => 'Mr. Bean\'s Holiday',
                'poster' => 'movies/5RU97PKsIMsSsSPdIGEm28gOY3Lvtbvc6imCBEPW.jpg',
                // 'link' => 'https://www.imdb.com/title/tt0453451/',
                'is_published' => true,
            ],

            // 5. Romance
            [
                'id' => 8,
                'name' => 'The Lake House',
                'poster' => 'movies/bJddXMu1YpyawZvtMQGN0bYuvFX9U0NEvtVRxxwc.png',
                // 'link' => 'https://www.imdb.com/title/tt0410297/',
                'is_published' => true,
            ],
            [
                'id' => 9,
                'name' => 'The Holiday',
                'poster' => 'movies/8o3srw3ItihWViprAG3OE7DOIA9j6ycS7xvLVprw.jpg',
                // 'link' => 'https://www.imdb.com/title/tt0457939/',
                'is_published' => true,
            ],
            [
                'id' => 10,
                'name' => 'The Best Christmas Pageant Ever',
                'poster' => 'movies/li1CGAFPcRnBdXfl0xt7Xcm86c8xYB3njDt5xK2B.jpg',
                // 'link' => 'https://www.imdb.com/title/tt2347285/',
                'is_published' => true,
            ],

            // 6. Horror
            [
                'id' => 11,
                'name' => 'The Substance',
                'poster' => 'movies/Rj4jNQTm4coBrLEkmkoX0UvA3yRfqUuytkBrw8ML.jpg',
                // 'link' => 'https://www.imdb.com/title/tt17526714/',
                'is_published' => false,
            ],
            [
                'id' => 12,
                'name' => 'Alien: Romulus',
                'poster' => 'movies/eBZJpMaid9wQfBeDJwotfn0untZHkuOChyChBQNA.jpg',
                // 'link' => 'https://www.imdb.com/title/tt18412256/',
                'is_published' => true,
            ],

            // 7. Western
            [
                'id' => 13,
                'name' => 'The Magnificent Seven',
                'poster' => 'movies/ExDWsHaTcYM7bXdIT9nFSFo6mdkTHO25N1ah6BVL.jpg',
                // 'link' => 'https://www.imdb.com/title/tt2404435/',
                'is_published' => true,
            ],
            [
                'id' => 14,
                'name' => 'Pedro Paramo',
                'poster' => 'movies/77drZ0zwGSG3ZytZCYruAhmpX1vAch96p0Ad0BRP.jpg',
                // 'link' => 'https://m.imdb.com/title/tt27717667/',
                'is_published' => false,
            ],
        ]);
    }
}
