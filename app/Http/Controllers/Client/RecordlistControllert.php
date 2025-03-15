<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecordlistControllert extends Controller
{
    public function index(){
        //return 'This is Dashboard';

         return view('client.record_list');
    }
}
