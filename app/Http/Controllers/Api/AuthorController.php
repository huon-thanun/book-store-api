<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return response()->json([
            'result' => true,
            'message' => 'Authors retrieved successfully',
            'data' => Author::all(),
        ]);
    }

    public function store(Request $request)
    {
        $author = Author::create($request->all());

        return response()->json([
            'result' => true,
            'message' => 'Author created successfully',
            'data' => $author,
        ]);
    }

    public function show(string $id)
    {
        $author = Author::find($id);

        return response()->json([
            'result' => true,
            'message' => 'Author found successfully',
            'data' => $author,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $author = Author::find($id);
        $author->update($request->all());

        return response()->json([
            'result' => true,
            'message' => 'Author updated successfully',
            'data' => $author,
        ]);
    }

    public function destroy(string $id)
    {
        Author::destroy($id);

        return response()->json([
            'result' => true,
            'message' => "Deleted Author ID {$id} successfully",
        ]);
    }
}
