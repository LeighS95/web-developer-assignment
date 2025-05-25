<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Book::query();

        if ($search) {
            $query
                ->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        }

        $books = $query->get();

        return view('book', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $valiated = $request->validate([
                'title' => 'required',
                'author' => 'required',
            ]);

            Book::create($valiated);

            return redirect()->back()->with('success', 'New book added.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to add book');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $book = Book::find($id);

        $book->update(['author' => $request['author']]);

        return redirect()->back()->with('message', 'Author has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Book::destroy($id);

        return redirect()->back()->with('success', 'Book deleted successfully');
    }
}
