<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function store()
    {

        $data = $this->validateRequest();

        $book =  Book::create($data);

        return redirect($book->path());
    }

    public function update(Book $book)
    {
        $data = $this->validateRequest();

        $book->update($data);

        return redirect($book->path());
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }

    private function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }
}
