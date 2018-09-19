<?php

namespace ReclutaTI\Http\Middleware;

use Closure;

class SecureProtocol
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
        /*if($this->app->environment('production') && !$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }*/

        return $next($request);
    }
}
