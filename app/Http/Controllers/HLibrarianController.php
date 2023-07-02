<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Books;
use App\Models\Events;
use App\Models\Librarians;
use App\Models\Member;
use App\Models\Ratings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            "firstName" => ['required', 'max:255'],
            "lastName" => ['required', 'max:255'],
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
            "firstName" => ['max:255'],
            "lastName" => ['max:255'],
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

    //start of methods for the books
    public function indexBooksH(){
        $books = Books::all();

        return view('head_librarian.books', compact('books'));
    }

    public function showBookH($id){
        $book = Books::findOrFail($id);

        return view('head_librarian.show_book', compact('book'));
    }


    //end of methods for the books

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

    public function indexEvents(Request $request){
        // $data = Events::all();
        if($request->ajax()){
            $data = Events::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('head_librarian.events');
    }

    public function storeEvents(Request $request){

        if($request->ajax())
        {
            if($request->type == 'add')
            {
                $event = Events::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                   
                ]);

                return response()->json($event);
            }
        }
        else if (!$request->ajax())
        {
           
            $event = Events::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
                
            ]);

            return redirect()->route('head_librarian.view.events')->with('message', 'New event was created successfully!');
              
        }



        // $validated = $request->validate([
        //     "title" => ['required', 'min:4'],
        //     "description" => ['required'],
        //     "date" => ['required'],
            
        // ]);
        // return redirect()->route('head_librarian.view.events')->with('message', 'New event was created successfully!');
    }

    // public function editEvents($id){
    //     $event = Events::findOrFail($id);

    //     return view('head_librarian.edit_event', compact('event'));
    // }

    public function updateEvents(Request $request){
        if($request->type == 'update'){

            $event = Events::find($request->id)->update([   
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);

            return response()->json($event);

        }

        // $validated = $request->validate([
        //     "title" => ['required', 'min:4'],
        //     "description" => ['required'],
        //     "date" => ['required'],
        // ]);

        // $events->where('id', $request->id)->update([   
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'date' => $request->date,
        // ]);

        // return redirect()->route('head_librarian.view.events')->with('message', 'The event was updated successfully!');
    }

    public function destroyEvents(Request $request){

        if($request->type == 'delete')
        {
            $event = Events::find($request->id)->delete();

            return response()->json($event);
        }
        // $events->where('id', $request->id)->delete();

        // return redirect()->route('head_librarian.view.events')->with('message', 'The event was deleted successfully!');

    }


    // end of methods for events module.

    // start of methods for feedbacks module.
    public function indexFeeds(Request $request){
        $data = Ratings::all();

        return view('head_librarian.feedbacks', compact('data'));
    }

    public function feedbackShow($id){
        $user_id = Ratings::where('id', '=', $id)->limit(1)->get();

        $member_info = Member::where('user_id', '=', $user_id[0]->user_id)
                               ->orderBy('created_at', 'desc')
                               ->first();

        return view('head_librarian.show_feedback', compact('member_info', 'user_id'));

    }

    public function feedbackUpdate(Request $request, $id, Ratings $feedback){
        $request->validate([
            "id" => ['required'],
        ]);

        $feedback->where('id', $request->id)->update([   
            "reviewed" => 1,
        ]);

        return redirect()->route('head_librarian.view.feedbacks')->with('message', 'Feeback was successfully reviewed!');

    }


    // end of methods for feedbacks module.


}
