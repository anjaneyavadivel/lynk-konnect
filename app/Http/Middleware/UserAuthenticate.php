<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('access_token') && !$request->headers->get('Authorization')) $request->headers->set('Authorization', 'Bearer ' . $request->get('access_token'));
        if (!$request->headers->get('Authorization')) abort(401);
        return $next($request);
    }
}
