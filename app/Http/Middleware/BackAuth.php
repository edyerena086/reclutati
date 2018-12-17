<?php

namespace ReclutaTI\Http\Middleware;

use Auth;
use Closure;
use ReclutaTI\Role;

class BackAuth
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
            return redirect()->intended('back');
        } else if (Auth::user()->role_id != \ReclutaTI\Role::ADMIN) {
            return back();
        }

        return $next($request);
    }
}
