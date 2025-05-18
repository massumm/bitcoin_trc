<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AllowMultipleSessions
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Get the current session ID
            $currentSessionId = Session::getId();
            
            // Store the session ID in the user's session
            Session::put('user_session_id', $currentSessionId);
        }

        return $next($request);
    }
} 