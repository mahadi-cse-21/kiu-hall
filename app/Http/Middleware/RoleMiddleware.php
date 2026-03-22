<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if($request->user() and $request->user()->role !=$role)
        {
            return abort(403,'Unauthorised request');
            //return redirect()->route('dashboard')->with('error',"You aren't allowed to that request!");
        }
        return $next($request);
    }
}
