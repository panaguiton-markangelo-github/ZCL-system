<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;

class CLibrarianController extends Controller
{
    public function home()
    {
        $users = User::limit(10)->get();
        $books = Books::limit(10)->get();
        $allBooks = Books::all();
        $allUsers = User::all();

        return view('catalog_librarian.dashboard_catalog_librarian', compact('users', 'books', 'allBooks', 'allUsers'));

    }

    public function indexBooks(){
        $books = Books::all();
        return view('catalog_librarian.books', compact('books'));
    }

    public function storeBooks(Request $request)
    {
        $validated = $request->validate([
            "title" => ['required'],
            "author" => ['required'],

            "place_pub" => ['required'],
            "edition_vol" => ['required'],
            "pagination" => ['required'],
            "source" => ['required'],
            "series" => ['required'],
            "incls" => ['required'],
            "date_acq" => ['required'],
            "property_no" => ['required'],
            "acc_no" => ['required'],
            "amount" => ['required'],
            "call_no" => ['required'],
            "lc" => ['required'],
            "ddc" => ['required'],
            "author_no" => ['required'],
            "c" => ['required'],
            "section" => ['required'],

            "published" => ['required'],
            "subject" => ['required'],
            "publisher" => ['required'],
            "isbn" => ['required'],
            "summary" => ['required'],
            "collection" => ['required'],
            "shelf_location" => ['required'],
            "status" => ['required'],
            
        ]);

        $announcement = Books::create([
            "title" => $request->title,
            "author" => $request->author,

            "place_pub" => $request->place_pub,
            "edition_vol" => $request->edition_vol,
            "pagination" => $request->pagination,
            "source" => $request->source,
            "series" => $request->series,
            "incls" => $request->incls,
            "date_acq" => $request->date_acq,
            "property_no" => $request->property_no,
            "acc_no" => $request->acc_no,
            "amount" => $request->amount,
            "call_no" => $request->call_no,
            "lc" => $request->lc,
            "ddc" => $request->ddc,
            "author_no" => $request->author_no,
            "c" => $request->c,
            "section" => $request->section,

            "published" => $request->published,
            "subject" => $request->subject,
            "publisher" => $request->publisher,
            "isbn" => $request->isbn,
            "summary" => $request->summary,
            "collection" => $request->collection,
            "shelf_location" => $request->shelf_location,
            "price" => 0,
            "status" => $request->status,
        ]);

        return redirect()->route('catalog_librarian.view.books')->with('message', 'New book was created successfully!');
    }

    public function showBook($id){
        $book = Books::findOrFail($id);

        return view('catalog_librarian.show_book', compact('book'));
    }

    public function editBook($id){
        $book = Books::findOrFail($id);

        return view('catalog_librarian.edit_book', compact('book'));
    }

    public function updateBook(Request $request, Books $books){
        $validated = $request->validate([
            "title" => ['required'],
            "author" => ['required'],

            "place_pub" => ['required'],
            "edition_vol" => ['required'],
            "pagination" => ['required'],
            "source" => ['required'],
            "series" => ['required'],
            "incls" => ['required'],
            "date_acq" => ['required'],
            "property_no" => ['required'],
            "acc_no" => ['required'],
            "amount" => ['required'],
            "call_no" => ['required'],
            "lc" => ['required'],
            "ddc" => ['required'],
            "author_no" => ['required'],
            "c" => ['required'],
            "section" => ['required'],

            "published" => ['required'],
            "subject" => ['required'],
            "publisher" => ['required'],
            "isbn" => ['required'],
            "summary" => ['required'],
            "collection" => ['required'],
            "shelf_location" => ['required'],
            "status" => ['required'],
        ]);

        $books->where('id', $request->id)->update([   
            "title" => $request->title,
            "author" => $request->author,

            "place_pub" => $request->place_pub,
            "edition_vol" => $request->edition_vol,
            "pagination" => $request->pagination,
            "source" => $request->source,
            "series" => $request->series,
            "incls" => $request->incls,
            "date_acq" => $request->date_acq,
            "property_no" => $request->property_no,
            "acc_no" => $request->acc_no,
            "amount" => $request->amount,
            "call_no" => $request->call_no,
            "lc" => $request->lc,
            "ddc" => $request->ddc,
            "author_no" => $request->author_no,
            "c" => $request->c,
            "section" => $request->section,

            "published" => $request->published,
            "subject" => $request->subject,
            "publisher" => $request->publisher,
            "isbn" => $request->isbn,
            "summary" => $request->summary,
            "collection" => $request->collection,
            "shelf_location" => $request->shelf_location,
            "price" => 0,
            "status" => $request->status,
           
        ]);

        return redirect()->route('catalog_librarian.view.books')->with('message', 'Book details was updated successfully!');
    }

    public function destroyBook(Request $request, Books $books)
    {
        $books->where('id', $request->id)->delete();

        return redirect()->route('catalog_librarian.view.books')->with('message', 'Book was deleted successfully!');
    }
}
