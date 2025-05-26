<?php

namespace Tests\Feature\Services;

use App\Book;
use App\Services\BookService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen'],
            ['title' => 'Alice in Wonderland', 'author' => 'Lewis Carroll'],
            ['title' => 'Adventures of Tom Sawyer', 'author' => 'Mark Twain'],
        ];
    }

    public function test_get_export_data_returns_all_books()
    {
        Book::create($this->data[0]);
        Book::create($this->data[1]);

        $service = new BookService();
        $data = $service->getExportData(['title', 'author']);

        $this->assertCount(2, $data);
        $this->assertArrayHasKey('title', $data[0]);
        $this->assertArrayHasKey('author', $data[0]);
    }

    public function test_get_export_data_returns_all_books_with_given_columns()
    {
        Book::create($this->data[0]);
        Book::create($this->data[1]);

        $service = new BookService();
        $data = $service->getExportData(['title']);

        $this->assertCount(2, $data);
        $this->assertArrayHasKey('title', $data[0]);
        $this->assertArrayNotHasKey('author', $data[0]);
    }

    public function test_get_book_list_applies_search_and_sort()
    {
        Book::create($this->data[0]);
        Book::create($this->data[1]);
        Book::create($this->data[2]);

        $service = new BookService();
        $books = $service->getBookList('Wonderland', 'title');

        $this->assertCount(1, $books);
        $this->assertEquals('Lewis Carroll', $books->first()->author);
    }

    public function test_store_new_book_creates_book_in_database()
    {
        $service = new BookService();
        $book = $service->storeNewBook($this->data[0]);

        $this->assertDatabaseHas('books', [
            'title' => $this->data[0]['title'],
            'author' => $this->data[0]['author'],
        ]);

        $this->assertEquals($this->data[0]['title'], $book->title);
        $this->assertEquals($this->data[0]['author'], $book->author);
    }
}
