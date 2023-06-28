<?php

namespace App\Http\Controllers;

use App\Models\BookBorReq;
use App\Models\Librarians;
use App\Models\User;
use App\Notifications\LibrarianRequestNotification;
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
                'info' => "Request to borrow book/s (PENDING): at $date_time",
                'remarks' => "Sent for approval request",
                'id' => auth()->user()->id,
                'book' => "none",
                'username' => $user->firstName.' '.$user->lastName,
                'avail_date' => "book_req",
                'due_date' => "book_req",
        ];
        

        $user->notify(new RequestNotification($info));

        $bor_lib = Librarians::where('type', '=', '2')->get();

        $info_lib = [
            'info' => "Request to borrow book/s (PENDING): at $date_time",
            'user_id' => auth()->user()->id,
            'user_firstName' => auth()->user()->firstName,
            'user_lastName' => auth()->user()->lastName,
            'type' => "book_request",
        ];

        foreach ($bor_lib as $bor_lib_id) {
            $bor_lib_id->notify(new LibrarianRequestNotification($info_lib));
        }

        //end send notification via database

        Cart::destroy();
        
        return redirect()->route('dashboard')->with('message', 'Book Borrow Request was successfully sent for verification!');
    }
}
