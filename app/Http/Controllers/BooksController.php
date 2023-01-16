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

        //check if the current user has already filed for member card application or is already a member
        if ($member_data = Member::where('user_id', auth()->user()->id)->get()){
            session(['member' => $member_data], 'none');
        }
        
        return view('dashboard', compact('books', 'cart'));
    }

    public function show($id){
        $book = Books::findOrFail($id);
        $cart = Cart::content();
        return view('book_view', compact('book', 'cart'));
    }
}
