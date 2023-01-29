<?php

namespace App\Http\Controllers\LibAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {

            if(Auth::guard('librarians')->user()->type == 1){
                return $request->user()->hasVerifiedEmail()
                    ? redirect()->route('head_librarian.dashboard')
                    : view('librarian.auth.verify-email');

            }
            else if(Auth::guard('librarians')->user()->type == 2){
                return $request->user()->hasVerifiedEmail()
                    ? redirect()->route('borrowing_librarian.dashboard')
                    : view('librarian.auth.verify-email');    
            }
            else if(Auth::guard('librarians')->user()->type == 3){
                return $request->user()->hasVerifiedEmail()
                    ? redirect()->route('catalog_librarian.dashboard')
                    : view('librarian.auth.verify-email');    
            }
        }

    }
}
