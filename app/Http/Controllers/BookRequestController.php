<?php

namespace App\Http\Controllers;

use App\Models\BookBorReq;
use App\Models\User;
use App\Notifications\RequestNotification;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BookRequestController extends Controller
{
    public function create(){
        $cart = Cart::content();
        return view('book_request', compact('cart'));
    }
    
    public function store(Request $request){
        

        $request->validate([
            "book_reqs" => ['required']
        ]);

        $input['book_reqs'] = $request->input('book_reqs');
        
        if (empty($input['book_reqs'])){
            return redirect()->route('dashboard')->with('message', 'You did not select any book to boroow!');
        }
        elseif ($input['book_reqs'] >= 1){
            foreach ($input['book_reqs'] as $req){
                BookBorReq::create([
                    "book_id" =>  $req,
                    "member_id" => session('member.0.id'),
                    "status" => 'PENDING',
               ]);
            }  
        }

        //send notification via database
        $date_time = Carbon::now()->toDateTimeString();

        // Notification::send($user, new RequestNotification("Request to borrow books: $date_time"));

        $cur_user = auth()->user()->id;

        $user = User::find($cur_user);

        $info = [
                'info' => "Request to borrow books (PENDING): $date_time",
                'id' => auth()->user()->id,

        ];
        

        $user->notify(new RequestNotification($info));

        //end send notification via database

        Cart::destroy();
        
        return redirect()->route('dashboard')->with('message', 'Book Borrow Request was successfully sent for verification!');
    }
}
