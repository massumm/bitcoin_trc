<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function uploadProfileImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'profile_' . Auth::id() . '.' . $image->getClientOriginalExtension();
                
                // Store in public/assets/img
                $image->move(public_path('assets/img'), $filename);
                
                // Update user's profile image in database if needed
                // DB::table('users')->where('id', Auth::id())->update(['profile_image' => $filename]);

                return response()->json([
                    'success' => true,
                    'message' => 'Image uploaded successfully',
                    'image_url' => asset('assets/img/' . $filename)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No image file found'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }
} 