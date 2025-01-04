<?php

namespace Tests\Feature;

use App\Models\Genre;
use App\Models\Movie;
use Database\Seeders\TestSeeder;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\DB;
use Tests\TestCase;

// Use helpers for the response inspection:
// 
// $response->dumpHeaders();
// $response->dumpSession();
// $response->dump();
// 
// $response->ddHeaders();
// $response->ddSession();
// $response->dd();


// Routes
// 
// php artisan route:list --name=movies

//      GET        movies .................... movies.index     › MovieController@index
//      GET        movies/create ............. movies.create    › MovieController@create
//      GET        movies/{movie}/edit ....... movies.edit      › MovieController@edit
//      GET        preview ................... movies.preview   › MovieController@preview
// 
// (C)  POST       movies .................... movies.store     › MovieController@store
// (R)  GET        movies/{movie} ............ movies.show      › MovieController@show
// (U)  PUT|PATCH  movies/{movie} ............ movies.update    › MovieController@update
// (U)  PATCH      movies/{movie}/publicity .. movies.publicity › MovieController@publicity
// (D)  DELETE     movies/{movie} ............ movies.destroy   › MovieController@destroy


// (C)  POST       api/v1/movies ............. api1.movies.store   › Api\V1\MovieController@store
// (R)  GET        api/v1/movies ............. api1.movies.index   › Api\V1\MovieController@index
// (R)  GET        api/v1/movies/{movie} ..... api1.movies.show    › Api\V1\MovieController@show
// (U)  PUT        api/v1/movies/{movie} ..... api1.movies.update  › Api\V1\MovieController@update
// (D)  DELETE     api/v1/movies/{movie} ..... api1.movies.destroy › Api\V1\MovieController@destroy

class MovieTest extends TestCase
{
    use RefreshDatabase;

    // public function setUp(): void
    // {
    //     parent::setUp();

    //     DB::statement('ALTER SEQUENCE genres_id_seq RESTART WITH 1');
    //     DB::statement('ALTER SEQUENCE movies_id_seq RESTART WITH 1');

    //     // $this->artisan('migrate:fresh');
    // }

    public function tearDown(): void
    {
        $posters = Movie::whereNotNull('poster')
            ->select('poster')
            ->get()
            ->toArray();

        if (count($posters) > 0) {
            // var_dump(count($posters));

            foreach ($posters as &$poster) {
                Storage::disk('public')->delete($poster);
            }
        }

        parent::tearDown();
    }

    public function test_success_on_rendering_of_the_index_page(): void
    {
        $response = $this->get(route('movies.index'));

        $response->assertStatus(200); // Ok
        $response->assertViewHas('page.component', 'Movies/Index');
        $response->assertViewHas('page.props.movies.total', 0);
    }

    public function test_success_on_rendering_of_the_creation_page(): void
    {
        $response = $this->get(route('movies.create'));

        $response->assertStatus(200); // Ok
        $response->assertViewHas('page.component', 'Movies/Create');
    }

    public function test_success_on_rendering_of_the_edit_page(): void
    {
        $this->seed(TestSeeder::class);

        $movie = Movie::first();
        $response = $this->get(route('movies.edit', $movie->id));

        $response
            ->assertStatus(200) // Ok
            ->assertViewHas('page.component', 'Movies/Edit')
            ->assertViewHas('page.props.movie', [
                ...$movie->toArray(),
                'genresIDs' => [1],
            ])
            ->assertViewHas('page.props.genres', [
                ['id' => 1, 'name' => 'Action'],
                ['id' => 2, 'name' => 'Comedy'],
            ])
            ->assertViewHas(
                'page.props.statuses',
                Movie::getStatuses()
            )
        ;
    }

    // .................................................................

    public function test_success_on_creating_movie_without_poster(): void
    {
        $this->seed(TestSeeder::class);

        $movieName = fake()->lexify('movie_????');
        $movieGenres = [Genre::first()->id];

        $response = $this->post(route('movies.store'), [
            'name' => $movieName,
            'genres' => $movieGenres,
            // 'poster' => [optional]
        ]);

        $response->assertValid();
        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('success', 'Movie created successfully')
            ->assertRedirectToRoute('movies.index');

        // $movie = Movie::with('genres')->find(3);
        $movie = Movie::with('genres')
            ->where('name', $movieName)
            ->first();

        $this->assertEquals($movieName, Request::input('name'));
        $this->assertEquals($movieGenres, Request::input('genres'));

        $this->assertEquals($movieName, $movie->name);
        $this->assertEquals($movieGenres, $movie->genres
            ->pluck('id')->toArray());
    }

    public function test_success_on_creating_movie_with_poster(): void
    {
        $this->seed(TestSeeder::class);

        $movieName = fake()->lexify('movie_????');
        $movieGenres = [Genre::first()->id];

        // Storage::fake('movies');
        $posterFile = UploadedFile::fake()->image('new_movie_test.jpg');
        $posterPath = 'movies/' . $posterFile->hashName();

        $response = $this->post(route('movies.store'), [
            'name' => $movieName,
            'genres' => $movieGenres,
            'poster' => $posterFile, // [optional]
        ]);

        $response->assertValid();
        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('success', 'Movie created successfully')
            ->assertRedirectToRoute('movies.index');

        // $movie = Movie::with('genres')->find(3);
        $movie = Movie::with('genres')
            ->where('name', $movieName)
            ->first();

        $this->assertEquals($movieName, Request::input('name'));
        $this->assertEquals($movieGenres, Request::input('genres'));

        $this->assertEquals($movie->name, $movieName);
        $this->assertEquals($movieGenres, $movie->genres
            ->pluck('id')->toArray());

        $this->assertEquals($movie->posterExist, true);
        $this->assertEquals($movie->poster, $posterPath);

        // Storage::disk('movies')->assertExists($posterPath);
    }

    public function test_success_on_updating_movie(): void
    {
        $this->seed(TestSeeder::class);

        $oldMovie = Movie::with('genres')->first();
        $movieOldGenres = $oldMovie->genres->pluck('id')->toArray();

        $movieNewName = fake()->lexify('movie_????');
        $movieNewGenres = Genre::select('id')
            ->whereNotIn('id', $movieOldGenres)
            ->pluck('id')
            ->toArray();

        $response = $this->put(route('movies.update', $oldMovie->id), [
            'name' => $movieNewName,
            'genres' => $movieNewGenres,
            // 'poster' => '...', [optional]
        ]);

        $response->assertValid();

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('success', 'Movie updated successfully')
            ->assertRedirectToRoute('movies.index');

        // $movie = Movie::with('genres')->find(3);
        // $movie = Movie::find(1)->append(['genresIDs']);
        $newMovie = Movie::with('genres')
            ->where('name', $movieNewName)
            ->first();

        $this->assertEquals($movieNewName, Request::input('name'));
        $this->assertEquals($movieNewGenres, Request::input('genres'));

        $this->assertEquals($movieNewName, $newMovie->name);
        $this->assertEquals($movieNewGenres, $newMovie->genres
            ->pluck('id')->toArray());
    }

    public function test_success_on_updating_publicity(): void
    {
        $published = true;

        $movie = Movie::factory()->create([
            'published' => !$published,
        ]);

        $response = $this->patch(route('movies.publicity', $movie->id), [
            'published' => $published,
        ]);

        $response
            ->assertValid()
            ->assertStatus(302) // Found
            ->assertSessionHas('success', 'Movie published successfully')
            ->assertRedirect();

        $updMovie = $movie->fresh();

        $this->assertEquals($published, Request::input('published'));
        $this->assertEquals($published, $updMovie->published);
        $this->assertEquals(!$published, $movie->published);
    }

    public function test_success_on_reading_movie(): void
    {
        $this->seed(TestSeeder::class);

        $movie = Movie::with('genres')->first();

        $response = $this->get(route('movies.show', $movie->id));
        $response
            ->assertStatus(200) // Ok
            ->assertViewHas('page.component', 'Movies/Show')
            ->assertViewHas('page.props.movie', $movie->toArray());
    }

    public function test_success_on_deleteting_movie(): void
    {
        $movie = Movie::factory()->create();
        $this->assertModelExists($movie);

        $response = $this->delete(route('movies.destroy', $movie->id));
        $this->assertModelMissing($movie);

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('success', 'Movie deleted successfully')
            ->assertRedirect();
    }

    // .................................................................

    public function test_failure_on_creating_an_empty_movie_name(): void
    {
        $response = $this->post(route('movies.store'), [
            'name' => '',
        ]);

        $response
            ->assertInvalid([
                'name' => 'The name field is required.',
            ])
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    public function test_failure_on_creating_a_short_movie_name(): void
    {
        $response = $this->post(route('movies.store'), [
            'name' => 'Ro',
        ]);

        $response
            ->assertInvalid('name')
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    public function test_failure_on_creating_a_long_movie_name(): void
    {
        $response = $this->post(route('movies.store'), [
            'name' => str_repeat('abcdefghij', 9),
        ]);

        $response
            ->assertInvalid('name')
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    // .................................................................

    public function test_failure_on_updating_an_empty_movie_name(): void
    {
        $movie = Movie::factory()->create();
        $this->assertModelExists($movie);

        $response = $this->patch(route('movies.update', $movie->id), [
            'name' => '',
        ]);

        $response
            ->assertInvalid([
                'name' => 'The name field is required.',
            ])
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    public function test_failure_on_updating_a_short_movie_name(): void
    {
        $movie = Movie::factory()->create();
        $this->assertModelExists($movie);

        $response = $this->patch(route('movies.update', $movie->id), [
            'name' => 'A',
        ]);

        $response
            ->assertInvalid('name')
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    public function test_failure_on_updating_a_long_movie_name(): void
    {
        $movie = Movie::factory()->create();
        $this->assertModelExists($movie);

        $response = $this->patch(route('movies.update', $movie->id), [
            'name' => str_repeat('abcdefghij', 9),
        ]);

        $response
            ->assertInvalid('name')
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    // .................................................................

    public function test_failure_on_updating_a_non_existent_movie(): void
    {
        $response = $this->patch(route('movies.update', 1000000));
        $response->assertStatus(404); // Not Found
    }

    public function test_failure_on_reading_a_non_existent_movie(): void
    {
        $response = $this->get(route('movies.show', 1000000));
        $response->assertStatus(404); // Not Found
    }

    public function test_failure_on_deleting_a_non_existent_movie(): void
    {
        $response = $this->delete(route('movies.destroy', 1000000));
        $response->assertStatus(404); // Not Found
    }
}
