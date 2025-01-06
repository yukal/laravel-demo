<?php

namespace Tests\Feature;

use App\Models\Genre;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
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
// php artisan route:list --name=genres
// 
//      GET        genres ...................... genres.index   › GenreController@index
//      GET        genres/create ............... genres.create  › GenreController@create
//      GET        genres/{genre}/edit ......... genres.edit    › GenreController@edit
// 
// (C)  POST       genres ...................... genres.store   › GenreController@store
// (R)  GET        genres/{genre} .............. genres.show    › GenreController@show
// (U)  PUT|PATCH  genres/{genre} .............. genres.update  › GenreController@update
// (D)  DELETE     genres/{genre} .............. genres.destroy › GenreController@destroy

// GET         api/v1/genres .............................................................. api1.genres.index › Api\V1\GenreController@index
// POST            api/v1/genres .............................................................. api1.genres.store › Api\V1\GenreController@store
// GET         api/v1/genres/{genre} ........................................................ api1.genres.show › Api\V1\GenreController@show
// PUT             api/v1/genres/{genre} .................................................... api1.genres.update › Api\V1\GenreController@update
// DELETE          api/v1/genres/{genre} .................................................. api1.genres.destroy › Api\V1\GenreController@destroy

class GenreTest extends TestCase
{
    use RefreshDatabase;

    public function test_success_on_rendering_of_the_index_page(): void
    {
        $response = $this->get(route('genres.index'));

        $response->assertStatus(200); // Ok
        $response->assertViewHas('page.component', 'Genres/Index');
        $response->assertViewHas('page.props.genres.total', 0);
    }

    public function test_success_on_rendering_of_the_creation_page(): void
    {
        $response = $this->get(route('genres.create'));

        $response->assertStatus(200); // Ok
        $response->assertViewHas('page.component', 'Genres/Create');
    }

    public function test_success_on_rendering_of_the_edit_page(): void
    {
        $genre = Genre::factory()->create();

        $response = $this->get(route('genres.edit', $genre->id));

        $response->assertStatus(200); // Ok
        $response->assertViewHas('page.component', 'Genres/Edit');
        $response->assertViewHas('page.props.genre', $genre->toArray());
    }

    // .................................................................

    public function test_success_on_creating_genre(): void
    {
        $genreName = 'NewGenre';

        $response = $this->post(route('genres.store'), [
            'name' => $genreName,
        ]);

        $response->assertValid();
        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('success', 'Genre created successfully')
            ->assertRedirectToRoute('genres.index');

        $this->assertEquals($genreName, Request::input('name'));
        $this->assertDatabaseHas('genres', ['name' => $genreName]);
    }

    public function test_success_on_updating_genre(): void
    {
        $genre = Genre::factory()->create([
            'name' => 'Gastroscopy',
        ]);

        $newGenre = 'Thriller';
        $response = $this->put(route('genres.update', $genre->id), [
            'name' => $newGenre,
        ]);

        $response->assertValid();

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('success', 'Genre updated successfully')
            ->assertRedirectToRoute('genres.index');

        $this->assertEquals($newGenre, Request::input('name'));
        $this->assertEquals($newGenre, Genre::find($genre->id)->name);
    }

    public function test_success_on_reading_genre(): void
    {
        $genre = Genre::factory()->create();

        $response = $this->get(route('genres.show', $genre->id));
        $response->assertStatus(200); // Ok

        $response->assertViewHas('page.component', 'Genres/Show');
        $response->assertViewHas('page.props.genre', [
            ...$genre->toArray(),
            'movies' => [],
        ]);
    }

    public function test_success_on_deleteting_genre(): void
    {
        $genre = Genre::factory()->create();
        $response = $this->delete(route('genres.destroy', $genre->id));

        $this->assertDatabaseMissing('genres', ['id' => $genre->id]);

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('success', 'Genre deleted successfully')
            ->assertRedirectToRoute('genres.index');
    }

    // .................................................................

    public function test_failure_on_creating_an_empty_genre_name(): void
    {
        $response = $this->post(route('genres.store'), [
            'name' => '',
        ]);

        $response->assertInvalid([
            'name' => 'The name field is required.',
        ]);

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    public function test_failure_on_creating_a_short_genre_name(): void
    {
        $response = $this->post(route('genres.store'), [
            'name' => 'Ro',
        ]);

        $response->assertInvalid([
            'name' => 'The name field must be at least 3 characters.',
        ]);

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    public function test_failure_on_creating_a_long_genre_name(): void
    {
        $response = $this->post(route('genres.store'), [
            'name' => str_repeat('abcdef hi!', 6),
        ]);

        $response->assertInvalid([
            'name' => 'The name field must not be greater than 50 characters.',
        ]);

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    // .................................................................

    public function test_failure_on_updating_an_empty_genre_name(): void
    {
        $genre = Genre::factory()->create();

        $response = $this->patch(route('genres.update', $genre->id), [
            'name' => '',
        ]);

        $response->assertInvalid([
            'name' => 'The name field is required.',
        ]);

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    public function test_failure_on_updating_a_short_genre_name(): void
    {
        $genre = Genre::factory()->create();

        $response = $this->patch(route('genres.update', $genre->id), [
            'name' => 'A',
        ]);

        $response->assertInvalid([
            'name' => 'The name field must be at least 3 characters.',
        ]);

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    public function test_failure_on_updating_a_long_genre_name(): void
    {
        $genre = Genre::factory()->create();

        $response = $this->patch(route('genres.update', $genre->id), [
            'name' => str_repeat('abcdefghij', 6),
        ]);

        $response->assertInvalid([
            'name' => 'The name field must not be greater than 50 characters.',
        ]);

        $response
            ->assertStatus(302) // Found
            ->assertSessionHas('errors');
    }

    // .................................................................

    public function test_failure_on_updating_a_non_existent_genre(): void
    {
        $response = $this->patch(route('genres.update', 1000000));
        $response->assertStatus(404); // Not Found
    }

    public function test_failure_on_reading_a_non_existent_genre(): void
    {
        $response = $this->get(route('genres.show', 1000000));
        $response->assertStatus(404); // Not Found
    }

    public function test_failure_on_deleting_a_non_existent_genre(): void
    {
        $response = $this->delete(route('genres.destroy', 1000000));
        $response->assertStatus(404); // Not Found
    }
}
