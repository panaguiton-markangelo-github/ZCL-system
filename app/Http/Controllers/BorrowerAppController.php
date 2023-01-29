<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Professional;
use App\Models\Recommended;
use App\Models\Student;
use App\Models\User;
use App\Notifications\RequestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class BorrowerAppController extends Controller
{
    public function create(){
        //check if the current user has already filed for member card application or is already a member
        if ($member_data = Member::where('user_id', auth()->user()->id)->get()){
            session(['member' => $member_data], 'none');
        }

        return view('borrow_card');
    }

    public function store(Request $request){
        //type 0=NON-LGU, 1=LGU, 2=RECOMMENED
        //status PENDING, APPROVED, DECLINED
        $validated = $request->validate([
            "firstName" => ['required', 'min:4'],
            "lastName" => ['required', 'min:4'],
            "email" => ['required', 'email'],
            "phone" => ['required'],
            "address" => ['required'],
            "type" => ['required'],
            "id_card" => ['required']
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
                "rec_by" => ['required'],
                "rec_by_position" => ['required'],
                "rec_by_office" => ['required'],
                "rec_by_office_address" => ['required'],
                "rec_by_home_address" => ['required'],
                "rec_by_tel_no_work" => ['required'],
                "rec_by_cel_no" => ['required'],
            ]);
        }

        $member = Member::create([
            "user_id" => auth()->user()->id,
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
        if ($member_data = Member::where('user_id', auth()->user()->id)->get()){
            session(['member' => $member_data], 'none');
        }

        //send notification via database
        $date_time = Carbon::now()->toDateTimeString();

        $cur_user = auth()->user()->id;

        $user = User::find($cur_user);

        $info = [
                'info' => "Request for membership application (PENDING): $date_time",
                'id' => auth()->user()->id,

        ];
        

        $user->notify(new RequestNotification($info));

        //end send notification via database

        return redirect()->route('cart.view')->with('message', 'Borrower card application was successfully sent for verification!');

    }


}

