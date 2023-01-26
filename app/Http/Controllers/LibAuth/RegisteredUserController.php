<?php

namespace App\Http\Controllers\LibAuth;

use App\Http\Controllers\Controller;
use App\Models\Librarians;
use App\Providers\RouteServiceProvider;
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
        $hLibrarian = Librarians::where('type', '=', 1)->count();
        return view('librarian.auth.register', compact('hLibrarian'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Librarians::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Librarians::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        //Auth::guard('librarians')->login($user);

        return redirect()->route('librarian.login')->with('message', 'You have successfully registered!');
    }
}
