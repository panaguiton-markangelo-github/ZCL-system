<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Librarians;
use App\Models\Member;
use App\Models\Professional;
use App\Models\Recommended;
use App\Models\Student;
use App\Models\User;
use App\Notifications\LibrarianRequestNotification;
use App\Notifications\RequestNotification;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'b_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5000',
            "phone" => ['required'],
            "address" => ['required'],
            "type" => ['required'],
            "id_card" => ['required'],
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($request->stud_prof == "0"){
            $request->validate([
                "school" => ['required'],
                "oos" => ['required'],
                "school_level" => ['required'],
                "grade_year_level" => ['required'],
            ]);
            

        } elseif($request->stud_prof == "1"){
            $request->validate([
                "position" => ['required'],
                "office" => ['required'],
                "office_address" => ['required'],
                "tel_no_work" => ['required'],
            ]);
        }

        if($request->type == "2"){
            $request->validate([
                'r_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5000',
                "rec_by" => ['required'],
                "rec_by_position" => ['required'],
                "rec_by_office" => ['required'],
                "rec_by_office_address" => ['required'],
                "rec_by_home_address" => ['required'],
                "rec_by_tel_no_work" => ['required'],
                "rec_by_cel_no" => ['required'],
                
            ]);

            $r_image_path = $request->file('r_image')->store('r_id_images', 'public');
        }

        $b_image_path = $request->file('b_image')->store('b_id_images', 'public');
     

        $member = Member::create([
            "user_id" => $user->id,
            'b_image' => $b_image_path,
            "firstName" => $request->firstName,
            "lastName" => $request->lastName,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "type" => $request->type,
            "id_card" => $request->id_card,
            "status" => 'PENDING',
            
        ]);
        
        if ($request->stud_prof == "0"){
           Student::create([
                "member_id" => $member->id,
                "school" =>  $request->school,
                "out_of_school" => $request->oos,
                "school_level" => $request->school_level,
                "grade_year_level" => $request->grade_year_level
           ]);
        } elseif ($request->stud_prof == "1"){
            Professional::create([
                "member_id" => $member->id,
                "position" =>  $request->position,
                "office" => $request->office,
                "office_address" => $request->office_address,
                "tel_no_work" => $request->tel_no_work
           ]);
        }

        if ($request->type == "2"){
            Recommended::create([
                "member_id" => $member->id,
                'r_image' => $r_image_path,
                "rec_by" =>  $request->rec_by,
                "rec_by_position" => $request->rec_by_position,
                "rec_by_office" => $request->rec_by_office,
                "rec_by_office_address" => $request->rec_by_office_address,
                "rec_by_home_address" => $request->rec_by_home_address,
                "rec_by_tel_no_work" => $request->rec_by_tel_no_work,
                "rec_by_cel_no" => $request->rec_by_cel_no,
           ]);
        }

        //check if the current user has already filed for member card application or is already a member
        if ($member_data = Member::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(1)->get()){
            session(['member' => $member_data], 'none');
        }

        //send notification via database
        $date_time = Carbon::now()->toDateTimeString();

        $cur_user = $user->id;

        $user = User::find($cur_user);

       

        $info = [
                'info' => "You have applied for borrower card (PENDING): at $date_time",
                'remarks' => "Sent for approval request",
                'id' => $user->id,
                'book' => "none",
                'username' => $user->firstName.' '.$user->lastName,
                'avail_date' => "register",
                'due_date' => "register",
        ];
        

        $user->notify(new RequestNotification($info));

        $bor_lib = Librarians::where('type', '=', '2')->get();

        $info_lib = [
            'info' => "Application for borrower card (PENDING): at $date_time",
            'user_id' => $user->id,
            'user_firstName' => $user->firstName,
            'user_lastName' => $user->lastName,
            'type' => "borrower_card_app",
        ];

        foreach ($bor_lib as $bor_lib_id) {
            $bor_lib_id->notify(new LibrarianRequestNotification($info_lib));
        }

        //end send notification via database

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
