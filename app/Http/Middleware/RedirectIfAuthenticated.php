<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($guard == 'librarians' && Auth::guard($guard)->check() && Auth::guard($guard)->user()->type == 1) {
                return redirect()->route('head_librarian.dashboard');
            }

            if ($guard == 'librarians' && Auth::guard($guard)->check() && Auth::guard($guard)->user()->type == 2) {
                return redirect()->route('borrowing_librarian.dashboard');
            }

            if ($guard == 'librarians' && Auth::guard($guard)->check() && Auth::guard($guard)->user()->type == 3) {
                return redirect()->route('catalog_librarian.dashboard');
            }

            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
