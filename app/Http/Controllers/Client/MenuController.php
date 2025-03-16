<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        //return 'This is Dashboard';

         return view('client.screens.menu');
    }
    public function menudetails(Request $request)
    {
        // Retrieve 'id' and 'name' from the request
        $id = $request->query('id');
        $name = $request->query('name');
    
        return view('client.screens.menu_details', compact('id', 'name'));
    }
    
}
