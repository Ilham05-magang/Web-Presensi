<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roleName): Response
    {
        if(auth()->user()->role->role == $roleName && auth()->user()->status_akun == '1') {
            return $next($request);
        }
        return redirect()->back();
    }
}
