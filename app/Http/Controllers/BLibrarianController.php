<?php

namespace App\Http\Controllers;

use App\Models\BookBorReq;
use App\Models\Books;
use App\Models\Member;
use App\Models\Professional;
use App\Models\Recommended;
use App\Models\Student;
use App\Models\User;
use App\Notifications\RequestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BLibrarianController extends Controller
{
    public function home()
    {
        $borrowed_books = Books::where('status', '=', 'BORROWED')->limit(10)->get();

        $request_books = DB::table('book_bor_reqs')
        ->join('books', 'book_id', '=', 'books.id')
        ->join('members', 'member_id', '=', 'members.id')
        ->select('book_bor_reqs.status', 'books.title', 'members.firstName', 'members.lastName', 'book_bor_reqs.created_at')
        ->limit(10)
        ->get();
        
        $borrowers_app = DB::table('members')
        ->select('members.firstName', 'members.lastName', 'members.id_card', 'members.status', 'members.created_at' )
        ->limit(10)
        ->get();

        return view('borrowing_librarian.dashboard_borrowing_librarian', compact('borrowed_books', 'request_books', 'borrowers_app'));
    }

    //start borrowed books methods

    public function borrowedBooksIndex(){
        $borrowed_books = DB::table('books')
        ->join('book_bor_reqs', 'books.id', '=', 'book_bor_reqs.book_id')
        ->where('book_bor_reqs.status', '=', 'RELEASED')
        ->orWhere('book_bor_reqs.status', '=', 'RETURNED')
        ->orderBy('book_bor_reqs.created_at', 'desc')
        ->select('books.*','book_bor_reqs.id AS bookReqID','book_bor_reqs.status AS bookReqStatus', 'books.status AS bookStatus')
        ->get();

        
        return view('borrowing_librarian.borrowed_books', compact('borrowed_books'));
    }

    public function borrowedBooksShow($id, Books $book){
        $request_book = DB::table('book_bor_reqs')
        ->join('books', 'book_id', '=', 'books.id')
        ->where('book_bor_reqs.id', '=', $id)
        ->orderBy('book_bor_reqs.created_at', 'desc')
        ->select('book_bor_reqs.created_at', 'book_bor_reqs.id', 'book_bor_reqs.book_id', 'book_bor_reqs.member_id', 'books.title', 'books.author', 'books.published', 
                 'books.subject', 'books.publisher', 'books.isbn', 'books.summary', 
                 'books.collection', 'books.shelf_location', 'books.status',
                 'books.place_pub','books.edition_vol','books.pagination','books.date_acq',
                 'books.source','books.series','books.incls','books.property_no',
                 'books.acc_no','books.amount','books.call_no','books.lc',
                 'books.ddc','books.author_no','books.c','books.section', 'books.image',
                 'books.borrowed_at',
                 'book_bor_reqs.status AS bookReqStatus'
                 )
        ->limit(1)
        ->get();

        $member_info = Member::where('id', '=', $request_book[0]->member_id)
                               ->orderBy('created_at', 'desc')
                               ->first();

        return view('borrowing_librarian.show_borrower_info', compact('request_book', 'member_info'));
    }

    public function borrowedBooksUpdate($id, Books $book, BookBorReq $book_bor_req){
        $book->where('id', $id)->update([   
            "status" => 'AVAILABLE',
            "borrowed_at" => null,
        ]);

        $l_borrowed_books = DB::table('book_bor_reqs')
        ->where('book_id', '=', $id)
        ->where('status', '=', 'RELEASED')
        ->orderBy('created_at', 'desc')
        ->first();

        $book_bor_req->where('id', $l_borrowed_books->id)->update([   
            "status" => 'RETURNED',
        ]);

        return redirect()->route('borrowing_librarian.borrowed_books.view')->with('message', 'Book was successfully flagged as available again!');

    }



    //end borrowed books methods



    //start requested books methods 

    public function requestedBooksIndex(){
        $request_books = DB::table('book_bor_reqs')
        ->join('books', 'book_id', '=', 'books.id')
        ->join('members', 'member_id', '=', 'members.id')
        ->select('book_bor_reqs.created_at','book_bor_reqs.id','book_bor_reqs.book_id','book_bor_reqs.member_id','book_bor_reqs.status', 'books.title', 'books.image', 'members.firstName', 'members.lastName')
        ->orderBy('book_bor_reqs.created_at', 'desc')
        ->get();

        return view('borrowing_librarian.requested_books', compact('request_books'));

    }

    public function requestedBooksShow($id){
        $request_book = DB::table('book_bor_reqs')
        ->join('books', 'book_id', '=', 'books.id')
        ->where('book_bor_reqs.id', '=', $id)
        ->orderBy('book_bor_reqs.created_at', 'desc')
        ->select('book_bor_reqs.created_at', 'book_bor_reqs.id', 'book_bor_reqs.book_id', 'book_bor_reqs.member_id', 'books.title', 'books.author', 'books.published', 
                 'books.subject', 'books.publisher', 'books.isbn', 'books.summary', 
                 'books.collection', 'books.shelf_location', 'books.status',
                 'books.place_pub','books.edition_vol','books.pagination','books.date_acq',
                 'books.source','books.series','books.incls','books.property_no',
                 'books.acc_no','books.amount','books.call_no','books.lc',
                 'books.ddc','books.author_no','books.c','books.section', 'books.image',
                 'book_bor_reqs.status AS bookReqStatus'
                 )
        ->limit(1)
        ->get();

        $member_info = Member::where('id', '=', $request_book[0]->member_id)
                               ->orderBy('created_at', 'desc')
                               ->first();

        return view('borrowing_librarian.show_req_book', compact('request_book', 'member_info'));

    }

    public function requestedBooksUpdate(Request $request, BookBorReq $book_req, Books $book){
        
        $book_req->where('id', $request->id)->update([   
            "status" => $request->status,
        ]);

        if($request->status == "APPROVED")
        {
            $request->validate([
                "avail_date" => ['required'],
                "due_date" => ['required'],
            ]);
            
            $bookID = BookBorReq::find($request->id);
            $books_id = Books::where('id', '=', $bookID->book_id)->get();

            foreach ($books_id as $b_id) {

                $book_req->where('book_id', $b_id->id)->update([   
                    "avail_at" => $request->avail_date,
                    "due_at" => $request->due_date,
                ]);

                $date_time = Carbon::now()->toDateTimeString();

                $book->where('id', $b_id->id)->update([   
                    "status" => $request->statusBook,
                ]);

                $cur_member = BookBorReq::find($request->id);

                $cur_user = Member::find($cur_member->member_id);

                $user = User::find($cur_user->user_id);

            
                $info = [
                        'info' => "Your Book Request was APPROVED: Book Title($b_id->title) at $date_time",
                        'remarks' => "Available pickup at $request->avail_date.  
                                      Due date to be returned is on $request->due_date",
                        'id' => $user->id,
                        'book' => $b_id->title,
                        'username' => $user->firstName.' '.$user->lastName,
                        'avail_date' => $request->avail_date,
                        'due_date' => $request->due_date,
                ];
                

                $user->notify(new RequestNotification($info));
            }

            return redirect()->route('borrowing_librarian.requested_books.view')->with('message', 'Book borrow request was successfully approved!');
        }
        else if($request->status == "DECLINED")
        {
            $bookID = BookBorReq::find($request->id);
            $books_id = Books::where('id', '=', $bookID->book_id)->get();
            foreach ($books_id as $b_id) {
                $date_time = Carbon::now()->toDateTimeString();

                $cur_member = BookBorReq::find($request->id);

                $cur_user = Member::find($cur_member->member_id);

                $user = User::find($cur_user->user_id);

            
                $info = [
                        'info' => "Your Book Request was DECLINED: Book Title($b_id->title) at $date_time",
                        'remarks' => $request->remarks,
                        'id' => $user->id,
                        'book' => $b_id->title,
                        'username' => $user->firstName.' '.$user->lastName,
                        'avail_date' => "none",
                        'due_date' => "none",
                ];
                

                $user->notify(new RequestNotification($info));
            }

            return redirect()->route('borrowing_librarian.requested_books.view')->with('message', 'Book borrow request was successfully declined!');
        }
        else if($request->status == "CANCELLED")
        {
            $bookID = BookBorReq::find($request->id);
            $books_id = Books::where('id', '=', $bookID->book_id)->get();
            foreach ($books_id as $b_id) {
                $book_req->where('book_id', $b_id->id)->update([   
                    "avail_at" => null,
                    "due_at" => null,
                ]);

                $book->where('id', $b_id->id)->update([   
                    "status" => $request->statusBook,
                ]);

                $date_time = Carbon::now()->toDateTimeString();

                $cur_member = BookBorReq::find($request->id);

                $cur_user = Member::find($cur_member->member_id);

                $user = User::find($cur_user->user_id);

            
                $info = [
                        'info' => "Your Approved Book Request was CANCELLED: Book Title($b_id->title) at $date_time",
                        'remarks' => $request->remarks,
                        'id' => $user->id,
                        'book' => $b_id->title,
                        'username' => $user->firstName.' '.$user->lastName,
                        'avail_date' => "cancel",
                        'due_date' => "none",
                ];
                

                $user->notify(new RequestNotification($info));
            }

            return redirect()->route('borrowing_librarian.requested_books.view')->with('message', 'Approved Book borrow request was successfully cancelled!');
        }
        else if($request->status == "RELEASED")
        {
            $bookID = BookBorReq::find($request->id);
            $books_id = Books::where('id', '=', $bookID->book_id)->get();
            foreach ($books_id as $b_id) {                
                $date_time = Carbon::now()->toDateTimeString();

                $book->where('id', $b_id->id)->update([   
                    "status" => $request->statusBook,
                    "borrowed_at" => $date_time,
                ]);

                $cur_member = BookBorReq::find($request->id);

                $cur_user = Member::find($cur_member->member_id);

                $user = User::find($cur_user->user_id);

            
                $info = [
                        'info' => "Your Requested Book was Released: Book Title($b_id->title) at $date_time",
                        'remarks' => "
                        Important Note: Lost/Damaged Books = Replacement.
                        Over-due fine = Php 2.00/day per book",
                        'id' => $user->id,
                        'book' => $b_id->title,
                        'username' => $user->firstName.' '.$user->lastName,
                        'avail_date' => "released",
                        'due_date' => "Released on: ".$date_time,
                ];
                

                $user->notify(new RequestNotification($info));
            }

            return redirect()->route('borrowing_librarian.requested_books.view')->with('message', 'Approved Book borrow request was successfully released!');
        }
    }

    //end requested books methods


    //start borrowers card application methods
    public function borrowersCardIndex(){
        $borrowers_app = Member::orderBy('created_at', 'desc')->get();

        return view('borrowing_librarian.borrower_card_app', compact('borrowers_app'));

    }

    public function borrowersCardShow($id){
        $borrowers_app = Member::where('id', '=', $id)->limit(1)->get();

        $is_prof = Professional::where('member_id', '=', $id)->limit(1)->get();
        $is_stud = Student::where('member_id', '=', $id)->limit(1)->get();
        $is_rec = Recommended::where('member_id', '=', $id)->limit(1)->get();

        return view('borrowing_librarian.show_borrower_app', compact('borrowers_app', 'is_prof', 'is_stud', 'is_rec'));

    }

    public function borrowersCardUpdate(Request $request, Member $member){
        $member->where('id', $request->id)->update([   
            "status" => $request->status,
        ]);

        if($request->status == "APPROVED")
        {   
            $date_time = Carbon::now()->toDateTimeString();

            $cur_user = Member::find($request->id);

            $user = User::find($cur_user->user_id);

        
            $info = [
                    'info' => "Your Borrower Card Application was APPROVED: at $date_time",
                    'remarks' => "Application Approved",
                    'id' => $user->id,
                    'book' => "none",
                    'username' => $user->firstName.' '.$user->lastName,
                    'avail_date' => "card_approve",
                    'due_date' => "card_approve",
            ];
            

            $user->notify(new RequestNotification($info));

            return redirect()->route('borrowing_librarian.borrower_card_app.view')->with('message', 'Borrower Card Application was successfully approved!');
        }
        else if($request->status == "DECLINED")
        {
            $date_time = Carbon::now()->toDateTimeString();

            $cur_user = Member::find($request->id);

            $user = User::find($cur_user->user_id);

        
            $info = [
                    'info' => "Your Borrower Card Application was DECLINED: at $date_time",
                    'remarks' => $request->remarks,
                    'id' => $user->id,
                    'book' => "none",
                    'username' => $user->firstName.' '.$user->lastName,
                    'avail_date' => "card_decline",
                    'due_date' => "card_decline",
            ];
            

            $user->notify(new RequestNotification($info));
            return redirect()->route('borrowing_librarian.borrower_card_app.view')->with('message', 'Borrower Card Application was successfully declined!');
        }



    }
    

    //end borrowers card application methods

    //start noti methods

    public function notyIndex(){
        return view('borrowing_librarian.bl_noty_view');
    }

    //end noti methods

}
