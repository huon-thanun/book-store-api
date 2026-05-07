<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookDetail;
use Illuminate\Http\Request;

class BookDetailController extends Controller
{
    public function index()
    {
        return response()->json([
            'result' => true,
            'message' => 'Book details retrieved successfully',
            'data' => BookDetail::with('book')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id', 'unique:book_details,book_id'],
            'publisher' => ['required', 'string', 'max:255'],
            'language' => ['nullable', 'string', 'max:255'],
            'page_count' => ['required', 'integer', 'min:1'],
        ]);

        $bookDetail = BookDetail::create($validated)->load('book');

        return response()->json([
            'result' => true,
            'message' => 'Book detail created successfully',
            'data' => $bookDetail,
        ]);
    }

    public function show(string $id)
    {
        $bookDetail = BookDetail::with('book')->find($id);

        return response()->json([
            'result' => true,
            'message' => 'Book detail found successfully',
            'data' => $bookDetail,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $bookDetail = BookDetail::find($id);

        $validated = $request->validate([
            'book_id' => ['sometimes', 'exists:books,id', 'unique:book_details,book_id,' . $id],
            'publisher' => ['sometimes', 'string', 'max:255'],
            'language' => ['sometimes', 'string', 'max:255'],
            'page_count' => ['sometimes', 'integer', 'min:1'],
        ]);

        $bookDetail->update($validated);
        $bookDetail->load('book');

        return response()->json([
            'result' => true,
            'message' => 'Book detail updated successfully',
            'data' => $bookDetail,
        ]);
    }

    public function destroy(string $id)
    {
        BookDetail::destroy($id);

        return response()->json([
            'result' => true,
            'message' => "Deleted Book Detail ID {$id} successfully",
        ]);
    }
}
