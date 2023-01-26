<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Books;
use App\Models\Events;
use App\Models\Librarians;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class HLibrarianController extends Controller
{
    public function home(){
        $users = User::all()->count();
        $books = Books::all()->count();
        $events = Events::all()->count();
        $announcements = Announcements::all()->count();

        return view('head_librarian.dashboard_head_librarian', compact('users', 'books', 'events', 'announcements'));
    }

    public function index(){
        $data = Librarians::where('type', '!=', 1)->orderBy('id', 'desc')->get();

        return view('head_librarian.librarians', compact('data'));
    }

    // start of methods for adding,updating,deleting librarian users.
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

    // end of methods for adding,updating,deleting librarian users.

    //-----------------------------------------------------------------

    // start of methods for announcements module.

    public function indexAnnounce(){
        $data = Announcements::all();

        return view('head_librarian.announcements', compact('data'));
    }

    public function storeAnnounce(Request $request){
        $validated = $request->validate([
            "details" => ['required', 'min:4'],
            
        ]);

        $announcement = Announcements::create([
            'details' => $request->details,
        ]);

        return redirect()->route('head_librarian.view.announcements')->with('message', 'New announcement was created successfully!');
    }

    public function editAnnounce($id){
        $announcement = Announcements::findOrFail($id);

        return view('head_librarian.edit_announcements', compact('announcement'));
    }

    public function updateAnnounce(Request $request, Announcements $announcements){
        $validated = $request->validate([
            "details" => ['required', 'min:4'],
        ]);

        $announcements->where('id', $request->id)->update([   
            'details' => $request->details,
           
        ]);

        return redirect()->route('head_librarian.view.announcements')->with('message', 'The announcement was updated successfully!');
    }

    public function destroyAnnounce(Request $request, Announcements $announcements){

        $announcements->where('id', $request->id)->delete();

        return redirect()->route('head_librarian.view.announcements')->with('message', 'The announcement was deleted successfully!');

    }

    // end of methods for announcements module.


    //----------------------------------------------------------------


    // start of methods for events module.

    public function indexEvents(){
        $data = Events::all();

        return view('head_librarian.events', compact('data'));
    }

    public function storeEvents(Request $request){
        $validated = $request->validate([
            "title" => ['required', 'min:4'],
            "description" => ['required'],
            "date" => ['required'],
            
        ]);

        $event = Events::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('head_librarian.view.events')->with('message', 'New event was created successfully!');
    }

    public function editEvents($id){
        $event = Events::findOrFail($id);

        return view('head_librarian.edit_event', compact('event'));
    }

    public function updateEvents(Request $request, Events $events){
        $validated = $request->validate([
            "title" => ['required', 'min:4'],
            "description" => ['required'],
            "date" => ['required'],
        ]);

        $events->where('id', $request->id)->update([   
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('head_librarian.view.events')->with('message', 'The event was updated successfully!');
    }

    public function destroyEvents(Request $request, Events $events){

        $events->where('id', $request->id)->delete();

        return redirect()->route('head_librarian.view.events')->with('message', 'The event was deleted successfully!');

    }



    // end of methods for events module.


}
