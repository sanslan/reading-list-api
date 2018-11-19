<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $books = Book::where('user_id',$user_id)->get();
        return response()->json( $books,200);
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
            'title'=> ['required'],
            'description'=> ['required'],
            'image'=> ['image'],
        ]);
        $imagename = $request->image->store('');

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagename,
            'user_id' => auth()->user()->id,
            'books_category_id' => $request->category
        ]);

        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->json( $book, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        if($request->image){
            $imagename = $request->image->store('');
        }else{
            $imagename = $book->image;
        }
        $title = $request->title ?? $book->title;
        $description = $request->description ?? $book->description;
        $category = $request->category ?? $book->books_category_id;
        $book->update([
            'title' => $title,
            'description' => $description,
            'books_category_id' => $category,
            'image' => $imagename
        ]);
        return response()->json( $book, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json( $book, 200);
    }
}
