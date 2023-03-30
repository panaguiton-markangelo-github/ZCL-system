<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Member;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(){
        // $books = Books::where('status', '==', "AVAILABLE")->orderBy('created_at', 'DESC')->get();
        // $books = Books::all();
        $cart = Cart::content();

        //check if the current user has already filed for member card application or is already a member
        if ($member_data = Member::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(1)->get()){
            session(['member' => $member_data], 'none');
        }

        $is_status_member  = Member::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(1)->get();
        
       
        $books = Books::orderBy('id', 'DESC')->get();
      
        return view('dashboard', compact('books', 'cart', 'is_status_member'));
    }

    public function show($id){
        $book = Books::findOrFail($id);
        $cart = Cart::content();
        return view('book_view', compact('book', 'cart'));
    }
}
