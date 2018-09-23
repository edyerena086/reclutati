<?php

namespace ReclutaTI\Http\Middleware;

use Auth;
use Closure;

class RecruiterAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->intended('recruiter');
        } else if (Auth::user()->role_id != \ReclutaTI\Role::RECRUITER) {
            return back();
        }

        return $next($request);
    }
}
