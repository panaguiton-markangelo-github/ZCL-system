<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
       
        return view('landpage.index');
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
