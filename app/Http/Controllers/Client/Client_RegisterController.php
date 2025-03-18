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
        // $request->validate([
        //     'name' => ['required', 'string', 'max:100'],
        //     'number' => ['required', 'string', 'max:20', 'unique:users,number'],
        //     'password' => ['required', 'string', 'min:6', 'confirmed'],
        //     'withdraw_pass' => ['required', 'string', 'min:6'],
        //     'refer_by' => ['nullable', 'string', 'max:100'],
        // ]);

        // Generate a unique referral code
       $refer_code = 'REF' . rand(10000, 99999);

        // Create user
        User2::create([
            'name' => $request->name,
            'number' => $request->number,
            'password' => Hash::make($request->password),
            'withdraw_pass' => Hash::make($request->withdraw_pass),
            'refer_code' => $refer_code,
            'refer_by' => $request->refer_by ?? null,
            'balance' => 0.00,
            'refer_earn' => 0.00,
            'status' => '1',
        ]);

        return redirect()->back()->with('success', 'Registration successful!');
    }
}
