<?php

namespace App\Http\Controllers;

use App\Models\BookBorReq;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PTransController extends Controller
{
    public function index(){
        $cur_member = Member::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(1)->get();

        $request_book = DB::table('book_bor_reqs')
        ->join('books', 'book_id', '=', 'books.id')
        ->where('member_id', '=', $cur_member[0]->id)
        ->orderBy('book_bor_reqs.created_at', 'desc')
        ->select('book_bor_reqs.avail_at', 'book_bor_reqs.due_at', 'book_bor_reqs.created_at', 'book_bor_reqs.updated_at', 'book_bor_reqs.member_id',
                 'books.title', 'book_bor_reqs.status AS bookReqStatus'
                )
        ->get();
        return view('trans_view', compact('request_book'));
    }
}
