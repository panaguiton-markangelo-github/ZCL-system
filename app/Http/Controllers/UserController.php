<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = User::where('email', '!=', "")->orderBy('firstName', 'asc')->limit(2)->get();
        // $users = User::all();
        
        return view('dashboard', compact('users'));
    }
}
