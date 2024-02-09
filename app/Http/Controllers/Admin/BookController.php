<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Services\BookService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookResource;
use App\Http\Requests\Store\BookStoreRequest;
use App\Http\Requests\Update\BookUpdateRequest;
use App\Http\Requests\Book\BookTransactionRequest;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->bookService->getAll();
        $hello = Helpers::helloWorld();
        return response()->json([
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        $data = $request->validated();
        $book = $this->bookService->create($data);

        return response()->json([
            'message' => 'Book created successfully.',
            'data' => $book,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $post = $this->bookService->findByUuid($uuid);
        return new BookResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, string $uuid)
    {
        $data = $request->validated();
        $this->bookService->updateUuid($uuid, $data);

        return response()->json([
            'message' => 'Book Updated successfully.',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $post = $this->bookService->destroyByUuid($uuid);

        return response()->json([
            'message' => 'Book Deleted successfully.',
        ], 201);
    }

    public function borrowBook(BookTransactionRequest $request, string $uuid)
    {
        $data = $request->validated();
        $bookTransaction = $this->bookService->borrowBook($uuid, $data);

        return response()->json([
            'message' => 'Book borrowed successfully.',
            'data' => $bookTransaction,
        ], 201);
    }
}
