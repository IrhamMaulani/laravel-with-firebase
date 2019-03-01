<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::getAllBooks();

        return view('view.name')->with('books', $books);
    }

    public function show($bookId)
    {
        $book = Book::getById($bookId);

        return view('view.name')->with('book', $book);
    }

    public function delete($bookId)
    {
        $book = Book::delete($bookId);

        if ($book) {
            return view('view.name')->with('message', 'Successfully Deleted Book');
        } else {
            return view('view.name')->with('message', 'Failed Deleted Book');
        }
    }
}