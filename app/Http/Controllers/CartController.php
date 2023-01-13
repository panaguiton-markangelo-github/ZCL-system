<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::content();
        return view('cart_view', compact('cart'));
    }

    public function store(Request $request){
        $book = Books::findOrFail($request->input('book_id'));
        Cart::add(
            $book->id, 
            $book->title,
            $request->input('quantity'),
            $book->price 
            );
        
        return redirect()->route('dashboard')->with('message', 'Successfully added!');
    }

    public function remove(Request $request){
        $rowId = $request->input('row_id');

        Cart::remove($rowId);

        return redirect()->route('cart.view')->with('message', 'Successfully deleted!');

    }
}
