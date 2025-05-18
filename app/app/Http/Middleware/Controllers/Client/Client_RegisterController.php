<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User2;

class Client_RegisterController extends Controller
{
    public function index(){
        //return 'This is login';
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        
        }else{
           return view('client.auth.register');
        }


    }
    public function create_client(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'refer_by' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if referral code exists
        $referrer = User2::where('refer_code', $request->refer_by)->first();
        if (!$referrer) {
            return redirect()->back()
                ->withErrors(['refer_by' => 'Invalid referral code'])
                ->withInput();
        }

        // Generate a unique referral code
        $refer_code = rand(10000, 99999);

        // Create user
        $user = User2::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'reveal_pass' => $request->password,
            'refer_code' => $refer_code,
            'refer_by' => $request->refer_by,
            'balance' => 0.00,
            'refer_earn' => 0.00,
            'status' => '0',
            'demostatus' => 0
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to home with success message
        return redirect('/admin/dashboard')->with('success', 'Registration successful! Welcome to your dashboard.');
    }
}
