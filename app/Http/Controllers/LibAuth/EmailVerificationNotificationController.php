<?php

namespace App\Http\Controllers\LibAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {

            if(Auth::guard('librarians')->user()->type == 1){
                return redirect()->route('head_librarian.dashboard');
            }
            else if(Auth::guard('librarians')->user()->type == 2){
                return redirect()->route('borrowing_librarian.dashboard');
    
            }
            else if(Auth::guard('librarians')->user()->type == 3){
                return redirect()->route('catalog_librarian.dashboard');
    
            }
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
