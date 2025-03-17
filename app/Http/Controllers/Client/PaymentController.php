<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   

    public function deposit(){
        return view('client.screens.deposit');
    }
    public function virtualdetail(Request $request)
    {
        // Retrieve 'id' and 'name' from the request
        return view('client.screens.virtualdetail');
    }
    
}
