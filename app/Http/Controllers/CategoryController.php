<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'hbkey' => 'required|unique:categories',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $category = Category::create($request->all());

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'hbkey' => 'required|unique:categories,hbkey,' . $category->id,
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }

    public function addToBook(Request $request, Category $category, Book $book)
    {
        $book->categories()->attach($category->id);
        return response()->json(['message' => 'Categoría añadida al libro'], 200);
    }
}
