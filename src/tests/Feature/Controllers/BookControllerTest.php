<?php

namespace Tests\Feature\Controllers;

use App\Book;
use App\Services\BookService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $mockData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockData = [
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen'],
            ['title' => 'Alice in Wonderland', 'author' => 'Lewis Carroll'],
            ['title' => 'Adventures of Tom Sawyer', 'author' => 'Mark Twain'],
        ];

        // disable csrf token for tests
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_index_displays_books()
    {
        Book::create($this->mockData[0]);
        Book::create($this->mockData[1]);

        $response = $this->get('/books');

        $response->assertStatus(200);
        $response->assertViewHas('books');
        $response->assertViewIs('book');
    }

    public function test_store_adds_new_book()
    {
        $response = $this->post('/books', [
            'title' => 'New Book',
            'author' => 'Test Author',
        ]);

        $response->assertRedirect('/books');
        $response->assertSessionHas('success', 'New book added.');
        $this->assertDatabaseHas('books', ['title' => 'New Book', 'author' => 'Test Author']);
    }

    public function test_store_handles_errors()
    {
        // Simulate failure by omitting required fields
        $response = $this->from('/books')->post('/books', []);

        $response->assertRedirect('/books');
        $response->assertSessionHasErrors(['title', 'author']);
    }

    public function test_store_handles_exception()
    {
        // Mock BookService to throw an exception
        $this->mock(BookService::class, function ($mock) {
            $mock
                ->shouldReceive('storeNewBook')
                ->once()
                ->andThrow(new \Exception('Simulated failure'));
        });

        $response = $this->from('/books')->post('/books', [
            'title' => 'Invalid Book',
            'author' => 'Unknown Author',
        ]);

        $response->assertRedirect('/books');
        $response->assertSessionHas('error', 'Failed to add book');
        $response->assertSessionHasInput(['title' => 'Invalid Book', 'author' => 'Unknown Author']);
    }

    public function test_update_edits_book_author()
    {
        $book = Book::create($this->mockData[0]);

        $response = $this->put("/books/{$book->id}", [
            'author' => 'Updated Author',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Author has been edited successfully');

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $book->title,
            'author' => 'Updated Author',
        ]);
    }

    public function test_destroy_deletes_book_and_redirects_back()
    {
        $book = Book::create($this->mockData[0]);

        $response = $this->delete("/books/{$book->id}");

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Book deleted successfully');
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
