<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderlistController extends Controller
{
    public function getRandomProducts()
    {
        // Check if ordering is allowed
        $orderAllowed = true; // Replace with your condition
    
        if ($orderAllowed) {
            // Fetch 5 random products from the database
            $products = DB::table('products')->inRandomOrder()->limit(5)->get();
            return response()->json($products);
        }
    
        return response()->json(['message' => 'Ordering is not allowed'], 403);
    }
    
}
