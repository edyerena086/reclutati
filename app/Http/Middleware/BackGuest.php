<?php

namespace ReclutaTI\Http\Middleware;

use Auth;
use Closure;

class BackGuest
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
        if (Auth::check()) {
            return (Auth::user()->role_id == \ReclutaTI\Role::ADMIN) ? redirect('back/dashboard') : back();
        }

        return $next($request);
    }
}
