<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mengambil data 'book' dan juga 'author'
        // yang berelasi melalui method 'author'
        // yang berasal dari model 'Book'
        $books = Book::with('author')->get();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengambil data author
        $author = Author::all();
        return view('book.create', compact('author'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:books',
            'amount' => 'required',
            'author_id' => 'required',
            'cover' => 'required|image|max:2048',
        ]);

        $book = new Book;
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        // upload image / foto
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('image/book/', $name);
            $book->cover = $name;
        }
        $book->amount = $request->amount;
        $book->save();
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $author = Author::all();
        return view('book.show', compact('book', 'author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $author = Author::all();
        return view('book.edit', compact('book', 'author'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'author_id' => 'required',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        // upload image / foto
        if ($request->hasFile('cover')) {
            $book->deleteImage();
            $image = $request->file('cover');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('image/book/', $name);
            $book->cover = $name;
        }
        $book->amount = $request->amount;
        $book->save();
        return redirect()->route('book.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->deleteImage();
        $book->delete();
        return redirect()->route('book.index');
    }
}