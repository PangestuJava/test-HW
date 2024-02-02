<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(CategoryController::class)->group(function () {
        Route::GET('/categories', 'index');
        Route::GET('/category/{uuid}/detail', 'show');
        Route::POST('/category/create', 'store');
        Route::PUT('/category/{uuid}/update', 'update');
        Route::DELETE('/category/{uuid}/delete', 'destroy');
    });
});
