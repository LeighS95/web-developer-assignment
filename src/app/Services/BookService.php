<?php

namespace App\Services;

use App\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    /**
     * Get a list of Books
     * 
     * @return Collection
     */
    public function getBookList($search = null, $sortOrder = null): Collection
    {
        $query = Book::query();

        if ($search) {
            $query
                ->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        }

        if ($sortOrder) {
            $query->orderBy($sortOrder);
        }

        $books = $query->get();

        return $books;
    }

    /**
     * Store a new book
     * 
     * @return Book
     */
    public function storeNewBook(array $data): Book
    {
        $book = Book::create($data);
        $book->save();

        return $book;
    }
}