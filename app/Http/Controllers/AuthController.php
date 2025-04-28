<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function checkUsername(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string'
            ]);

            $name = $request->input('name');
            $exists = DB::table('users')->where('name', $name)->exists();
            
            return response()->json([
                'exists' => $exists,
                'message' => $exists ? 'Username already exists' : 'Username available'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error checking username'
            ], 500);
        }
    }

    public function register_client(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'refer_by' => 'nullable|string|exists:users,referral_code',
            'captcha' => 'required|string'
        ]);

        // Verify captcha
        if ($request->captcha !== session('captcha')) {
            return back()->with('error', 'Invalid verification code!');
        }

        // Generate referral code
        $referralCode = strtoupper(substr(md5(uniqid()), 0, 8));

        // Create user
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'referral_code' => $referralCode,
            'refer_by' => $request->refer_by,
            'demostatus'=>0,
            'role' => 'user'
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to home with success message
        return redirect()->route('client.home')->with('success', 'Registration successful! Welcome to your dashboard.');
    }
} 