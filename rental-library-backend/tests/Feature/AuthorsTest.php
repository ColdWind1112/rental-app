<?php

namespace Tests\Feature;

use App\Models\Authors;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_author()
    {
        $author = [
            'name' => $this->faker->name(),
            'surname' => $this->faker->name()
        ];

        $this->post('/api/authors/', $author)
            ->assertStatus(201)->assertJson($author);
    }

    public function test_update_author()
    {
        $author = Authors::factory()->make();
        $author->save();

        $authorUpdated = [
            'name' => $this->faker->name(),
            'surname' => $this->faker->name()
        ];

        $this->put('/api/authors/' . $author->id, $authorUpdated)
            ->assertStatus(200)->assertJson($authorUpdated);
    }

    public function test_delete_author()
    {
        $author = Authors::factory()->make();
        $author->save();


        $this->delete('/api/authors/' . $author->id)
            ->assertStatus(204);
    }

    public function test_list_author(){
        $author = Authors::factory()->make();
        $author->save();


        $this->get('/api/authors/' . $author->id)
            ->assertStatus(200)->assertJson($author->toArray());
    }

    public function test_list_all_authors(){
        $authors = Authors::factory()->count(3)->create();


        $this->get('/api/authors/')
            ->assertStatus(200)->assertJson($authors->toArray());
    }
}
