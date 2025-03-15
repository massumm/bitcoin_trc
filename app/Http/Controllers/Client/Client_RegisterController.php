<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

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
}
