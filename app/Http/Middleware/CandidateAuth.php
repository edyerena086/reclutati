<?php

namespace ReclutaTI\Http\Middleware;

use Closure;

class CandidateAuth
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
            return redirect()->intended('candidate');
        } else if (Auth::user()->role_id != \ReclutaTI\Role::CANDIDATE) {
            return back();
        }

        return $next($request);
    }
}
