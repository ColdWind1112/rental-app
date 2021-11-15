<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        return Books::with('authors')->get();
    }

    public function show($id)
    {
        return Books::find($id);
    }

    public function store(Request $request)
    {
        $book = Books::create($request->all());

        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $book = Books::findOrFail($id);
        $book->update($request->all());

        return response()->json($book, 200);
    }

    public function delete($id)
    {
        $book = Books::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
