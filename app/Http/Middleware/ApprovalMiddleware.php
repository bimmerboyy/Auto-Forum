<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ApprovalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        // Check if the user is authenticated and approved
        if (Auth::check() && Auth::user()->status !== 'approved') {
            // Redirect the user to the login route with a message
            return redirect()->route('login')->with('message', 'Your account needs admin approval.');
        }

        return $next($request);
    }
}
