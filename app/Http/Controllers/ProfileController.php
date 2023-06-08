<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\BookBorReq;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {   
        $user_id = auth()->user()->id;
        $member = Member::where('user_id', $user_id)->orderBy('created_at', 'desc')->limit(1)->get();

        if (count($member) > 0){
            $request_book = DB::table('book_bor_reqs')
            ->join('books', 'book_id', '=', 'books.id')
            ->where('book_bor_reqs.member_id', '=', $member[0]->id)
            ->where('books.status', '=', 'BORROWED')
            ->orderBy('book_bor_reqs.created_at', 'desc')
            ->select('book_bor_reqs.created_at', 'book_bor_reqs.id', 'book_bor_reqs.book_id', 'book_bor_reqs.member_id',)
            ->limit(1)
            ->get();


            return view('profile.edit', [
                'user' => $request->user(),
            ], compact('request_book', 'member'));
        }
        else {
            return view('profile.edit', [
                'user' => $request->user(),
            ]);
        }
 
       
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
