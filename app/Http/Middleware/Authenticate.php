<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;

// class Authenticate
// {
//     public function handle(Request $request, Closure $next, $guard = null)
//     {
//         // dd(Auth::user());
//         if (!Auth::check()) {
//             return redirect()->route('login');
//         }

//         return $next($request);
//     }
// }
 class Authenticate extends Middleware
 {
     /**
      * Get the path the user should be redirected to when they are not authenticated.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return string|null
      */
     protected function redirectTo($request)
     {
        Log::debug(Auth::user());
        return $request->expectsJson() ? null : route('login');
     }
 }