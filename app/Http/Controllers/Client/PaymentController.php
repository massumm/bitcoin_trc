<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
   

    public function deposit(){
        return view('client.screens.deposit');
    }
    public function postVirtualDetail(Request $request)
{
    try {
        // Validate the amount and order_number
    

        // Generate a unique transaction ID
        $trxid = 'TRX' . time() . rand(1000, 9999);

        // Check if the order_number already exists
        $existingDeposit = DB::table('deposit')->where('order_number', $request->orderNumber)->first();

        if ($existingDeposit) {
            // If order exists, update it
            DB::table('deposit')
                ->where('order_number', $request->orderNumber)
                ->update([
                    'user_id' => Auth::id(),
                    'user_name' => Auth::user()->name,
                    'trxid' => $trxid,
                    'amount' => $request->amount,
                    'status' => 'pending',
                    'date' => now(),
                ]);
        } else {
            // If order does not exist, insert a new record
            DB::table('deposit')->insert([
                'order_number' => $request->orderNumber,
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'trxid' => $trxid,
                'amount' => $request->amount,
                'status' => 'pending',
                'date' => now(),
                'image' => null // Will be updated when user uploads payment proof
            ]);
        }

        return response()->json([
            'success' => true,
            'amount' => $request->amount,
            'trxid' => $trxid,
            'order_number' => $request->orderNumber
        ]);
    } catch (\Exception $e) {
        \Log::error('Deposit processing failed: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Failed to process deposit. Please try again.' . $e->getMessage()
        ], 500);
    }
}

    public function virtualdetail(Request $request)
    {
        return view('client.screens.virtualdetail');
    }
    public function deposit_recordlist(Request $request)
    {
        $deposits = DB::table('deposit')
            ->where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        return view('client.screens.deposit_recordlist', compact('deposits'));
    }
    public function withdraw_recordlist(Request $request)
    {
        return view('client.screens.withdraw_recordlist');
    }
    public function withdraw(Request $request)
    {
        return view('client.screens.withdraw');
    }
}    
