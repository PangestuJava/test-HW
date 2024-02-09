<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookTransaction;

/**
 * Class BookService.
 */
class BookService extends BaseService
{

    public function __construct(Book $book)
    {
        parent::__construct($book);
    }

    public function borrowBook($uuid, $data)
    {
        $book = $this->findByUuid($uuid);

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
