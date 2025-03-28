<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use Illuminate\Http\Request;
use PHPUnit\Framework\Test;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Master'
        ]);

        $book = Book::first('id');

        // $response->assertOk();

        $this->assertCount(1, Book::all());

        $response->assertRedirect('/books/' . $book->id)->assertStatus(302);
    }

    public function test_a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Master'
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_a_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'A cool Title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    public function test_a_book_can_be_updated()
    {

        // $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Master',
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New title',
            'author' => 'New author',
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New author', Book::first()->author);

        $response->assertRedirect('/books/' . $book->id)->assertStatus(302);
    }

    public function test_a_book_can_be_deleted()
    {

        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Master',
        ]);

        $book = Book::first();

        $response = $this->delete('/books/' . $book->id);

        $this->assertCount(0, Book::all());

        $response->assertRedirect('/books')->assertStatus(302);
    }
}
