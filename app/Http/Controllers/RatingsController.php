<?php

namespace App\Http\Controllers;

use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            "rating" => ['required'],
            
        ]);
       
        $announcement = Ratings::create([
            'user_id' => auth()->user()->id,
            'comments' => $request->comment,
            'star_rating' => $request->rating,
        ]);

        return redirect()->back()->with('message','Your review has been submitted successfully,');
    }
}
