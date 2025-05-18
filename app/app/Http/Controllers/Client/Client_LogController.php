<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
class Client_LogController extends Controller
{
    public function index(){
        //return 'This is login';
        if (Auth::check()) {
            $adminController = new AdminController();
            $adminController->todays_checker(Auth::id());
            return redirect('/client/dashboard');
        
        }else{
           return view('client.auth.login');
        }


    }
}
