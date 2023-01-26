<?php

namespace App\Http\Controllers\LibAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibAuth\LoginRequest;
use App\Models\Librarians;
use App\Models\Member;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {   
        $hLibrarian = Librarians::where('type', '=', 1)->count();
        return view('librarian.auth.login', compact('hLibrarian'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        
        //to allow user to login via loginrequest controller
        $request->authenticate();

        $request->session()->regenerate();

        //head librian = 1, borrow librarian = 2, catalog librarian = 3
        if(Auth::guard('librarians')->user()->type == 1){
            return redirect()->route('head_librarian.dashboard')->with('message', 'You have successfully logged in!');

        }
        else if(Auth::guard('librarians')->user()->type == 2){
            return redirect()->route('borrowing_librarian.dashboard')->with('message', 'You have successfully logged in!');

        }
        else if(Auth::guard('librarians')->user()->type == 3){
            return redirect()->route('catalog_librarian.dashboard')->with('message', 'You have successfully logged in!');

        }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('librarians')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        session()->flush();

        return redirect()->route('librarian.login')->with('message', 'You have successfully logged out!');
    }
}
