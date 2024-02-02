<?php

namespace App\Services;

use App\Models\Book;

/**
 * Class BookService.
 */
class BookService
{
    public function getAllBook()
    {
        return Book::with('category')->get();
    }

    public function createBook(array $data)
    {
        return Book::create([
            'category_id' => $data['category'],
            'title' => $data['title'],
        ]);
    }

    public function getBookByUuid($uuid)
    {
        return Book::with('category')->where('uuid', $uuid)->first();
    }

    public function updateBook($uuid, array $data)
    {
        $book = $this->getBookByUuid($uuid);
        $book->update([
            'category_id' => $data['category'],
            'title' => $data['title'],
        ]);
    }

    public function deleteBook($uuid)
    {
        $book = $this->getBookByUuid($uuid);
        $book->delete();
    }
}
