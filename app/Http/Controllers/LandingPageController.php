<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Books;
use App\Models\Events;
use App\Models\Ratings;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        
        $data = Announcements::all();
        $books = Books::all();
        
        $ratings = Ratings::join('users', 'users.id', '=', 'ratings.user_id')
        ->get(['ratings.*', 'users.firstName', 'users.lastName']);

        return view('landpage.index', compact('data', 'ratings', 'books'));
    }

    public function fetchEvents(Request $request){
       
        if($request->ajax()){
            $data = Events::whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        
        }
        
    }
}
