<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'result' => true,
            'message' => 'Books retrieved successfully',
            'data' => Book::with('detail')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());

        return response()->json([
            'result' => true,
            'message' => 'Book created successfully',
            'data' => $book
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('detail')->find($id);

        return response()->json([
            'result' => true,
            'message' => 'Book found successfully',
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        $book->update($request->all());

        return response()->json([
            'result' => true,
            'message' => 'Updated successfully',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::destroy($id);

        return response()->json([
            'result' => true,
            'message' => "Deleted Book ID {$id} successfully",
        ]);
    }
}
