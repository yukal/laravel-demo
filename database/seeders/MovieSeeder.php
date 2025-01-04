<?php

namespace Database\Seeders;

use App\Models\Movie;

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

        Movie::factory()->createMany([
            // 1. Action
            [
                'name' => 'Gladiator',
                'poster' => 'movies/MWD8GDSMRxh48WUJmcxeB0RrWpbCnCd1rMLh9MUV.jpg',
                // 'link' => 'https://www.imdb.com/title/tt0172495/',
            ],
            [
                'name' => 'Gladiator 2',
                'poster' => 'movies/RTl8MRqeFkwcAyswPRWMl2Gx94DnJYIcTGUqzGcP.jpg',
                // 'link' => 'https://www.imdb.com/title/tt9218128/',
            ],

            // 2. Thriller
            [
                'name' => 'Killer Heat',
                'poster' => 'movies/CQM567zAiTZY7jaiT3LcSfbe5ZhhofM5IeEMkkEG.jpg',
                // 'link' => 'https://www.imdb.com/title/tt27419292/',
            ],

            // 3. Drama
            [
                'name' => 'Skin',
                'poster' => 'movies/gxGYfFakKkrBE0ztAKSQApojci2fJtVLMZVzDRI7.jpg',
                // 'link' => 'https://www.imdb.com/title/tt6043142/',
            ],
            [
                'name' => 'Megalopolis',
                'poster' => 'movies/CgwXUf3ykeAw4yve0z3RZE8XrvSgxrCQTTILNtZC.jpg',
                // 'link' => 'https://www.imdb.com/title/tt10128846/',
            ],

            // 4. Comedy
            [
                'name' => 'The Union',
                'poster' => 'movies/v0HSE478pCTqzykGmYtkBJ1Kx44KO4F1seJOZuO1.jpg',
                // 'link' => 'https://www.imdb.com/title/tt12610390/',
            ],
            [
                'name' => 'Mr. Bean\'s Holiday',
                'poster' => 'movies/5RU97PKsIMsSsSPdIGEm28gOY3Lvtbvc6imCBEPW.jpg',
                // 'link' => 'https://www.imdb.com/title/tt0453451/',
            ],

            // 5. Romance
            [
                'name' => 'The Lake House',
                'poster' => 'movies/bJddXMu1YpyawZvtMQGN0bYuvFX9U0NEvtVRxxwc.png',
                // 'link' => 'https://www.imdb.com/title/tt0410297/',
            ],
            [
                'name' => 'The Holiday',
                'poster' => 'movies/8o3srw3ItihWViprAG3OE7DOIA9j6ycS7xvLVprw.jpg',
                // 'link' => 'https://www.imdb.com/title/tt0457939/',
            ],
            [
                'name' => 'The Best Christmas Pageant Ever',
                'poster' => 'movies/li1CGAFPcRnBdXfl0xt7Xcm86c8xYB3njDt5xK2B.jpg',
                // 'link' => 'https://www.imdb.com/title/tt2347285/',
            ],

            // 6. Horror
            [
                'name' => 'The Substance',
                'poster' => 'movies/Rj4jNQTm4coBrLEkmkoX0UvA3yRfqUuytkBrw8ML.jpg',
                // 'link' => 'https://www.imdb.com/title/tt17526714/',
            ],
            [
                'name' => 'Alien: Romulus',
                'poster' => 'movies/eBZJpMaid9wQfBeDJwotfn0untZHkuOChyChBQNA.jpg',
                // 'link' => 'https://www.imdb.com/title/tt18412256/',
            ],

            // 7. Western
            [
                'name' => 'The Magnificent Seven',
                'poster' => 'movies/ExDWsHaTcYM7bXdIT9nFSFo6mdkTHO25N1ah6BVL.jpg',
                // 'link' => 'https://www.imdb.com/title/tt2404435/',
            ],
            [
                'name' => 'Pedro Paramo',
                'poster' => 'movies/77drZ0zwGSG3ZytZCYruAhmpX1vAch96p0Ad0BRP.jpg',
                // 'link' => 'https://m.imdb.com/title/tt27717667/',
            ],

            // Movies without assigned genres...

            // If a poster is not specified here, it will be created automatically.
            // See: database/factories/MovieFactory.php

            ['name' => 'Save The Earth'],
            ['name' => 'New Movie'],
        ]);
    }
}
