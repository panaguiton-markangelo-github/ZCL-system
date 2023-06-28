<?php

namespace App\Http\Controllers;

use App\Models\Librarians;
use App\Models\Member;
use App\Models\Professional;
use App\Models\Recommended;
use App\Models\Student;
use App\Models\User;
use App\Notifications\LibrarianRequestNotification;
use App\Notifications\RequestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Storage;

class BorrowerAppController extends Controller
{
    public function create(){
        //check if the current user has already filed for member card application or is already a member
        if ($member_data = Member::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(1)->get()){
            session(['member' => $member_data], 'none');
        }

        return view('borrow_card');
    }

    public function store(Request $request){
        //type 0=NON-LGU, 1=LGU, 2=RECOMMENED
        //status PENDING, APPROVED, DECLINED
        $validated = $request->validate([
            'b_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5000',
            "firstName" => ['required', 'max:255'],
            "lastName" => ['required', 'max:255'],
            "email" => ['required', 'email'],
            "phone" => ['required'],
            "address" => ['required'],
            "type" => ['required'],
            "id_card" => ['required'],
            
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
        }

        $b_image_path = $request->file('b_image')->store('b_id_images', 'public');
        $r_image_path = $request->file('r_image')->store('r_id_images', 'public');

        $member = Member::create([
            "user_id" => auth()->user()->id,
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
        if ($member_data = Member::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(1)->get()){
            session(['member' => $member_data], 'none');
        }

        //send notification via database
        $date_time = Carbon::now()->toDateTimeString();

        $cur_user = auth()->user()->id;

        $user = User::find($cur_user);

       

        $info = [
                'info' => "You have applied for borrower card (PENDING): at $date_time",
                'remarks' => "Sent for approval request",
                'id' => auth()->user()->id,
                'book' => "none",
                'username' => $user->firstName.' '.$user->lastName,
                'avail_date' => "borrower_card_app",
                'due_date' => "borrower_card_app",
        ];
        

        $user->notify(new RequestNotification($info));

        $bor_lib = Librarians::where('type', '=', '2')->get();

        $info_lib = [
            'info' => "Application for borrower card (PENDING): at $date_time",
            'user_id' => auth()->user()->id,
            'user_firstName' => auth()->user()->firstName,
            'user_lastName' => auth()->user()->lastName,
            'type' => "borrower_card_app",
        ];

        foreach ($bor_lib as $bor_lib_id) {
            $bor_lib_id->notify(new LibrarianRequestNotification($info_lib));
        }

        //end send notification via database

        return redirect()->route('dashboard')->with('message', 'Borrower card application was successfully sent for verification!');

    }

    public function show(Request $request){
        $id = $request->user_id;
        $member = Member::where('user_id', $id)->orderBy('created_at', 'desc')->limit(1)->get();
        $is_prof = Professional::where('member_id', '=', $member[0]->id)->limit(1)->get();
        $is_stud = Student::where('member_id', '=', $member[0]->id)->limit(1)->get();
        $is_rec = Recommended::where('member_id', '=', $member[0]->id)->limit(1)->get();

        return view('view_borrower_card', compact('member', 'is_prof', 'is_stud', 'is_rec'));
    }

    public function edit(Request $request){
        $id = $request->user_id;
        $member = Member::findOrFail($id);
        $is_prof = Professional::where('member_id', '=', $id)->limit(1)->get();
        $is_stud = Student::where('member_id', '=', $id)->limit(1)->get();
        $is_rec = Recommended::where('member_id', '=', $id)->limit(1)->get();

        return view('edit_borrower_card', compact('member', 'is_prof', 'is_stud', 'is_rec'));
    }

    public function update(Request $request, Member $members, Student $students, Professional $profs){
        $id = $request->id;
        $is_prof = Professional::where('member_id', '=', $id)->limit(1)->get();
        $is_stud = Student::where('member_id', '=', $id)->limit(1)->get();
        $member_img_path = Member::where('id', '=', $id)->limit(1)->get(['b_image']);

        $validated = $request->validate([
            'b_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5000',
            "email" => ['required', 'email'],
            "phone" => ['required'],
            "address" => ['required'],
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

        Storage::disk('public')->delete($member_img_path[0]->b_image);

        $b_image_path = $request->file('b_image')->store('b_id_images', 'public');

        $members->where('id', $id)->update([
            'b_image' => $b_image_path,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "id_card" => $request->id_card,
        ]);
        
        if($is_stud->count()){
            if ($request->stud_prof == "0"){
                $students->where('member_id', $id)->update([
                    "school" =>  $request->school,
                    "out_of_school" => $request->oos,
                    "school_level" => $request->school_level,
                    "grade_year_level" => $request->grade_year_level
               ]);
            }
            elseif ($request->stud_prof == "1"){
                DB::table('students')->where('member_id', $id)->delete();

                Professional::create([
                    "member_id" => $id,
                    "position" =>  $request->position,
                    "office" => $request->office,
                    "office_address" => $request->office_address,
                    "tel_no_work" => $request->tel_no_work
               ]);
            }

        } elseif($is_prof->count()){
            if ($request->stud_prof == "1"){
                $profs->where('member_id', $id)->update([
                        "position" =>  $request->position,
                        "office" => $request->office,
                        "office_address" => $request->office_address,
                        "tel_no_work" => $request->tel_no_work
                    ]);
            }
            elseif ($request->stud_prof == "0"){
                DB::table('professionals')->where('member_id', $id)->delete();

                Student::create([
                    "member_id" => $id,
                    "school" =>  $request->school,
                    "out_of_school" => $request->oos,
                    "school_level" => $request->school_level,
                    "grade_year_level" => $request->grade_year_level
                ]);
            }
        }
        
        
        //check if the current user has already filed for member card application or is already a member
        if ($member_data = Member::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->limit(1)->get()){
            session(['member' => $member_data], 'none');
        }

        //send notification via database
        $date_time = Carbon::now()->toDateTimeString();

        $cur_user = auth()->user()->id;

        $user = User::find($cur_user);


        $info = [
                'info' => "You have updated your borrower card details: at $date_time",
                'remarks' => "Notified",
                'id' => auth()->user()->id,
                'book' => "none",
                'username' => $user->firstName.' '.$user->lastName,
                'avail_date' => "borrower_card_update",
                'due_date' => "borrower_card_update",
        ];
        

        $user->notify(new RequestNotification($info));

        $bor_lib = Librarians::where('type', '=', '2')->get();

        $info_lib = [
            'info' => "Public user has updated his/her borrower card details: at $date_time",
            'user_id' => auth()->user()->id,
            'user_firstName' => auth()->user()->firstName,
            'user_lastName' => auth()->user()->lastName,
            'type' => "borrower_card_app",
        ];

        foreach ($bor_lib as $bor_lib_id) {
            $bor_lib_id->notify(new LibrarianRequestNotification($info_lib));
        }

        //end send notification via database

        return redirect()->route('dashboard')->with('message', 'Borrower card details was successfully updated!');
    }


}

