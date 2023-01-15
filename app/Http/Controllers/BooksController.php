<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Member;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(){
        // $books = Books::where('email', '!=', "")->orderBy('firstName', 'asc')->limit(2)->get();
        $books = Books::all();
        $cart = Cart::content();
        return view('dashboard', compact('books', 'cart'));
    }

    public function show($id){
        $book = Books::findOrFail($id);
        $cart = Cart::content();
        return view('book_view', compact('book', 'cart'));
    }
}
