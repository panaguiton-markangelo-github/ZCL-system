<?php

namespace App\Http\Controllers\LibAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            

            if(Auth::guard('librarians')->user()->type == 1){
                return redirect()->route('head_librarian.dashboard?verified=1');
            }
            else if(Auth::guard('librarians')->user()->type == 2){
                return redirect()->route('borrowing_librarian.dashboard?verified=1');
    
            }
            else if(Auth::guard('librarians')->user()->type == 3){
                return redirect()->route('catalog_librarian.dashboard?verified=1');
    
            }
            
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }


        if(Auth::guard('librarians')->user()->type == 1){
            return redirect()->route('head_librarian.dashboard?verified=1');
        }
        else if(Auth::guard('librarians')->user()->type == 2){
            return redirect()->route('borrowing_librarian.dashboard?verified=1');

        }
        else if(Auth::guard('librarians')->user()->type == 3){
            return redirect()->route('catalog_librarian.dashboard?verified=1');

        }

        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
