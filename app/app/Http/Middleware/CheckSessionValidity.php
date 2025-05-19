<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckSessionValidity
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionId = $request->session()->getId();
            
            // Check if the current session exists in the database
            $sessionExists = DB::table('sessions')
                ->where('id', $sessionId)
                ->where('user_id', $user->id)
                ->exists();

            if (!$sessionExists) {
                // If session doesn't exist, log out the user
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/')->with('error', 'Your session has been invalidated due to a login from another device.');
            }

            // Check if there are any other active sessions for this user
            $otherSessions = DB::table('sessions')
                ->where('user_id', $user->id)
                ->where('id', '!=', $sessionId)
                ->exists();

            if ($otherSessions) {
                // Delete other sessions
                DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->where('id', '!=', $sessionId)
                    ->delete();
            }
        }

        return $next($request);
    }
} 