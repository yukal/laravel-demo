<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Helpers\ImageHelper;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Movie::class;

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Movie $movie) {
            if ($movie->published && $movie->poster === null) {

                // Add poster if movie published but have no image

                $movie->poster = Storage::disk('public')->putFile('movies',
                    ImageHelper::createPNGImage(520, 768, $movie->name),
                );

                // $movie->poster = fake()->file(
                //     './storage/app/public/movies', 
                //     './storage/app/public/movies',
                //     true,
                // )

            }
        });
        // ->afterCreating(function (Movie $movie) {
        //     ...
        // });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->lexify('movie_????'),
            'published' => mt_rand(0, 1) == 1,
            'poster' => null,
        ];
    }
}
