<?php

namespace App\Http\Controllers;

use App\Models\Librarians;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class HLibrarianController extends Controller
{
    public function home(){
        return view('head_librarian.dashboard_head_librarian');
    }

    public function index(){
        $data = Librarians::where('type', '!=', 1)->orderBy('id', 'desc')->get();

        return view('head_librarian.librarians', compact('data'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            "firstName" => ['required', 'min:4'],
            "lastName" => ['required', 'min:4'],
            "email" => ['required', 'email', Rule::unique('librarians', 'email')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            "type" => ['required'],
        ]);

        $user = Librarians::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        return redirect()->route('librarians.view')->with('message', 'New librarian was added successfully!');
    }

    public function edit($id){
        $user = Librarians::findOrFail($id);
        return view('head_librarian.edit_librarian', compact('user'));
    }

    public function update(Request $request, Librarians $librarians){
        $validated = $request->validate([
            "firstName" => ['min:4'],
            "lastName" => ['min:4'],
            "email" => ['email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            "type" => [], 
        ]);

        $librarians->where('id', $request->id)->update([   
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->type,
        ]);

        return redirect()->route('librarians.view')->with('message', 'The details of the librarian was updated successfully!');
    }

    public function destroy(Request $request, Librarians $librarians){

        $librarians->where('id', $request->id)->delete();

        return redirect()->route('librarians.view')->with('message', 'The details of the librarian was deleted successfully!');

    }
}
