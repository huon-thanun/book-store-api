<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'result' => true,
            'message' => 'Categories retrieved successfully',
            'data' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'result' => true,
            'message' => 'Category created successfully',
            'data' => $category,
        ]);
    }

    public function show(string $id)
    {
        $category = Category::find($id);

        return response()->json([
            'result' => true,
            'message' => 'Category found successfully',
            'data' => $category,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->update($request->all());

        return response()->json([
            'result' => true,
            'message' => 'Category updated successfully',
            'data' => $category,
        ]);
    }

    public function destroy(string $id)
    {
        Category::destroy($id);

        return response()->json([
            'result' => true,
            'message' => "Deleted Category ID {$id} successfully",
        ]);
    }
}
