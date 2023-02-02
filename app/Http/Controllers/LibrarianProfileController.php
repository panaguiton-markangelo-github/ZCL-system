<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibrarianProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LibrarianProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {   
        //head librian = 1, borrow librarian = 2, catalog librarian = 3
        if(Auth::guard('librarians')->user()->type == 1){
            return view('head_librarian.profile.edit', [
                'user' => $request->user(),
            ]);
        }
        else if(Auth::guard('librarians')->user()->type == 2){
            return view('borrowing_librarian.profile.edit', [
                'user' => $request->user(),
            ]);
        }
        else if(Auth::guard('librarians')->user()->type == 3){
            return view('catalog_librarian.profile.edit', [
                'user' => $request->user(),
            ]);
        }  
       
       
    }

    /**
     * Update the user's profile information.
     */
    public function update(LibrarianProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('librarian.profile.edit')->with('status', 'profile-updated');
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

        Auth::guard('librarians')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
