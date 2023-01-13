<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowerAppController extends Controller
{
    public function index(){
        return view('borrow_card');
    }
}
