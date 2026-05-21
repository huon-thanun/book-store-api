<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public function create(): View
    {
        return view('books.create', [
            'authors' => Author::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author_id' => ['required', 'exists:authors,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        Book::create($validated);

        return redirect()->route('books.ui')->with('success', 'Book created successfully.');
    }

    public function edit(string $id): View
    {
        return view('books.edit', [
            'book' => Book::findOrFail($id),
            'authors' => Author::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author_id' => ['required', 'exists:authors,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        $book->update($validated);

        return redirect()->route('books.ui')->with('success', 'Book updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Book::findOrFail($id)->delete();

        return redirect()->route('books.ui')->with('success', 'Book deleted successfully.');
    }
}
