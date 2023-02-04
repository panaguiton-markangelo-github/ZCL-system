<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Member;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::content();

        $is_status_member  = Member::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(1)->get();

        return view('cart_view', compact('cart', 'is_status_member'));
    }

    public function store(Request $request){
        $book = Books::findOrFail($request->input('book_id'));
        Cart::add(
            $book->id, 
            $book->title,
            $request->input('quantity'),
            0
            );
        
        return redirect()->route('dashboard')->with('message', 'Successfully added!');
    }

    public function remove(Request $request){
        $rowId = $request->input('row_id');

        Cart::remove($rowId);

        return redirect()->route('cart.view')->with('message', 'Successfully deleted!');

    }
}
