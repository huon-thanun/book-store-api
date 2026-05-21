<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ui/books', [BookController::class, 'uiIndex'])->name('books.ui');
Route::get('/ui/books/create', [BookController::class, 'create'])->name('books.ui.create');
Route::post('/ui/books', [BookController::class, 'store'])->name('books.ui.store');
Route::get('/ui/books/{id}/edit', [BookController::class, 'edit'])->name('books.ui.edit');
Route::put('/ui/books/{id}', [BookController::class, 'update'])->name('books.ui.update');
Route::delete('/ui/books/{id}', [BookController::class, 'destroy'])->name('books.ui.destroy');
