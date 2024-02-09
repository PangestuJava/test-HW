<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\admin\LoopController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(BookController::class)->group(function () {
    Route::GET('/books', 'index');
    Route::GET('/book/{uuid}/detail', 'show');
    Route::POST('/book/create', 'store');
    Route::PUT('/book/{uuid}/update', 'update');
    Route::DELETE('/book/{uuid}/delete', 'destroy');

    Route::post('/books/{uuid}/borrow', 'borrowBook');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(CategoryController::class)->group(function () {
        Route::GET('/categories', 'index');
        Route::GET('/category/{uuid}/detail', 'show');
        Route::POST('/category/create', 'store');
        Route::PUT('/category/{uuid}/update', 'update');
        Route::DELETE('/category/{uuid}/delete', 'destroy');
    });

    Route::get('/loop', [LoopController::class, 'printNumbers']);
});
