<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApprovalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle(Request $request, Closure $next): Response
     {
         $route = $request->route();
         if ($route && in_array($route->getName(), ['login', 'login'])) {
             return $next($request);
         }

         // Check if the user is authenticated and approved
         if (Auth::guard('web')->check() && Auth::guard('web')->user()->status !== 'approved') {
             Auth::guard('web')->logout();
             return redirect()->route('login')->with('message', 'Your account needs admin approval.');
         }

         return $next($request);
     }
}
