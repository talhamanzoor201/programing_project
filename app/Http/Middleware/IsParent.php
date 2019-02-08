<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsParent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'Parent') {
                if (Auth::user()->status === 'suspended') {
                    abort(403, "Your account has been Suspended! Contact to Administrator.");
                }
                return $next($request);
            }
        }

        return redirect('/');
    }
}
