<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PNotifyController extends Controller
{
    public function index(){
       
        return view('noty_view');
    }
}
