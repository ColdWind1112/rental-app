<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        return Authors::with('books')->get();
    }

    public function show($id)
    {
        return Authors::find($id);
    }

    public function store(Request $request)
    {
        $author = Authors::create($request->all());

        return response()->json($author, 201);
    }

    public function update(Request $request, $id)
    {

        $author = Authors::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        $author = Authors::findOrFail($id);
        
        return response()->json($author->delete(), 204);
    }
}
