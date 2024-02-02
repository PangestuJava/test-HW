<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookTransaction;

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

    public function borrowBook($uuid, $data)
    {
        $book = $this->getBookByUuid($uuid);

        if (!$book->isAvailableForBorrowing()) {
            return response()->json(['message' => 'Book is not available for borrowing.'], 422);
        }

        $bookTransaction = BookTransaction::create([
            'user_id' => $data['user_id'],
            'book_id' => $book->id,
            'return_date' => $data['return_date'],
            'borrowed_at' => now(),
        ]);

        $book->update(['is_borrowed' => true]);

        return $bookTransaction;
    }
}
