<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View\View;

class BookController extends Controller
{
    public function uiIndex(): View
    {
        $books = Book::with(['author', 'category', 'bookDetail'])
            ->latest()
            ->get();

        return view('books.index', [
            'books' => $books,
            'totalBooks' => $books->count(),
            'totalAuthors' => $books->pluck('author_id')->filter()->unique()->count(),
            'totalCategories' => $books->pluck('category_id')->filter()->unique()->count(),
            'totalWithDetails' => $books->filter(fn(Book $book) => $book->bookDetail !== null)->count(),
        ]);
    }
}
