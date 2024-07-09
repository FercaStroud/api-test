<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'hbkey' => 'required|unique:books',
            'title' => 'required|string',
            'description' => 'required|string',
            'code' => 'required|string|unique:books',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    public function show(Book $book)
    {
        return $book;
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'hbkey' => 'required|unique:books,hbkey,' . $book->id,
            'title' => 'required|string',
            'description' => 'required|string',
            'code' => 'required|string|unique:books,code,' . $book->id,
        ]);

        $book->update($request->all());

        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->noContent();
    }

    public function addToUser(Request $request, Book $book, User $user)
    {
        $user->books()->attach($book->id);
        return response()->json(['message' => 'Libro añadido al usuario'], 200);
    }
}
