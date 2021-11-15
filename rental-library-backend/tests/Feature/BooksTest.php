<?php

namespace Tests\Feature;

use App\Models\Books;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_book()
    {
      $book = Books::factory()->make();

        $this->post('/api/books/', $book->toArray())
            ->assertStatus(201)->assertJson($book->toArray());
    }

    public function test_update_book()
    {
        $book = Books::factory()->create();

        $bookUpdated = Books::factory()->make();

        $this->put('/api/books/' . $book->id, $bookUpdated->toArray())
            ->assertStatus(200)->assertJson($bookUpdated->toArray());
    }

    public function test_delete_book()
    {
        $book = Books::factory()->create();


        $this->delete('/api/books/' . $book->id)
            ->assertStatus(204);
    }

    public function test_list_book(){
        $book = Books::factory()->create();

        $this->get('/api/books/' . $book->id)
            ->assertStatus(200)->assertJson($book->toArray());
    }

    public function test_list_all_books(){
        $books = Books::factory()->count(3)->create();


        $this->get('/api/books/')
            ->assertStatus(200)->assertJson($books->toArray());
    }
}
