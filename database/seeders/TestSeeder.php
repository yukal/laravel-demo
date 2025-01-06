<?php

namespace Database\Seeders;

// use App\Models\User;
use App\Models\Genre;
use App\Models\Movie;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $actionGenre = Genre::factory()->create(['name' => 'Action']);
        $comedyGenre = Genre::factory()->create(['name' => 'Comedy']);

        Movie::factory()->create(['name' => 'Gladiator'])
            ->genres()->attach([$actionGenre->id]);

        Movie::factory()->create(['name' => 'The Union'])
            ->genres()->attach([$comedyGenre->id]);
    }
}
