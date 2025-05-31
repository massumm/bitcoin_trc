<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use Carbon\Carbon;

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
        $existingDeposit = DB::table('deposit')->where('order_number', $request->orderNumber,'status',"Pending")->first();

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
                    'date' => $request->current_date,
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
                'date' =>$request->current_date,
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
        $withdraws = DB::table('withdraw')
        ->where('user_id', Auth::id())
        ->orderBy('date', 'desc')
        ->get();
        return view('client.screens.withdraw_recordlist', compact('withdraws'));
    }
    public function withdraw(Request $request)
    {
        return view('client.screens.withdraw');
    }
    public function card_manage(Request $request)
    {
        $wallets = DB::table('wallet')  
        ->where('user_id', Auth::id())
        ->orderBy('date', 'desc')
        ->get();
        return view('client.screens.wallet_manage', compact('wallets'));
    }
    public function postWallet(Request $request)
  
    {
        
        try {
            // Validate the form data
            $validated = $request->validate([
                'password' => 'required|string|max:255',
                'wallet_name' => 'required|string|max:255',
                'currency_protocol' => 'required|string',
                'wallet_address' => 'required|string|max:255',
                'names' => 'required|string|max:255',
            ]);
        
            // Get authenticated user ID
            $userId = Auth::id();
        
            // Check if the wallet exists for this user
            $existingWallet = DB::table('wallet')->where('user_id', $userId)->first();
        
            if ($existingWallet) {
                // Update existing wallet
                DB::table('wallet')
                    ->where('user_id', $userId)
                    ->update([
                        'user_name' => Auth::user()->name,
                        'wallet_name' => $validated['wallet_name'],
                        'currency_protocol' => $validated['currency_protocol'],
                        'wallet_address' => $validated['wallet_address'],
                        'names' => $validated['names'],
                        'date' => now()
                    ]);
            } else {
                // Insert new wallet record
                DB::table('wallet')->insert([
                    'user_id' => $userId,
                    'user_name' => Auth::user()->name,
                    'wallet_name' => $validated['wallet_name'],
                    'currency_protocol' => $validated['currency_protocol'],
                    'wallet_address' => $validated['wallet_address'],
                    'names' => $validated['names'],
                    'date' => now()
                ]);
            }
        
            // Update withdraw_status in users table
            DB::table('users')->where('id', $userId)->update(['withdraw_status' => 1,'withdraw_pass'=>$validated['password']]);
        
            return response()->json([
                'success' => true,
                'message' => $existingWallet ? 'Wallet updated successfully' : 'Wallet added successfully'
            ]);
        
        } catch (\Exception $e) {
            \Log::error('Wallet creation failed: ' . $e->getMessage());
        
            return response()->json([
                'success' => false,
                'message' => 'Failed to process wallet. Please try again.'
            ], 500);
        }
        

    }
    public function store_withdraw(Request $request)
    {
        try {
            // Validate the form data
            $validated = $request->validate([
                'amount' => 'required|numeric|min:0',
                'withdrawal_password' => 'required|string|max:255',
            ]);

            // Get user data
            $userId = Auth::id();
            $user = Auth::user();

            // Check if withdrawal is available
            if ($user->withdraw_status == 2) {
                return response()->json([
                    'success' => false,
                    'message' => 'Withdrawal not available. Please contact support.'
                ], 400);
            }

            // Check if user has completed 25 tasks
            if ($user->today_task >0 && $user->today_task < 25) {
                return response()->json([
                    'success' => false,
                    'message' => 'You need to complete 25 orders before applying for a withdrawal'
                ], 400);
            }

            // Check if withdrawal amount is greater than balance
            if ($validated['amount'] > $user->balance) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient balance for withdrawal'
                ], 400);
            }

            if ($validated['withdrawal_password'] != $user->withdraw_pass) {
                return response()->json([
                    'success' => false,
                    'message' => 'Withdrawal password is incorrect'
                ], 400);
            }

            $wallet = DB::table('wallet')->where('user_id', $userId)->first();
            $validated['address'] = $wallet->wallet_address;
            $validated['method'] = $wallet->currency_protocol;

            // Set withdrawal status depending on demo status
            $withdrawStatus = ($user->demostatus == 1) ? 'Success' : 'pending';

            // Check if the wallet exists for this user
            $existingWallet = DB::table('withdraw')->where('user_id', $userId)->first();

            // if ($existingWallet) {
            //     DB::table('withdraw')
            //         ->where('user_id', $userId)
            //         ->update([
            //             'user_name' => $user->name,
            //             'amount' => $validated['amount'],
            //             'status' => $withdrawStatus,
            //             'address' => $validated['address'],
            //             'method' => $validated['method'],
            //             'date' => now()
            //         ]);
            // } else {
            //     DB::table('withdraw')->insert([
            //         'user_id' => $userId,
            //         'user_name' => $user->name,
            //         'amount' => $validated['amount'],
            //         'status' => $withdrawStatus,
            //         'address' => $validated['address'],
            //         'method' => $validated['method'],
            //         'date' => now()
            //     ]);
            // }
                DB::table('withdraw')->insert([
                    'user_id' => $userId,
                    'user_name' => $user->name,
                    'amount' => $validated['amount'],
                    'status' => $withdrawStatus,
                    'address' => $validated['address'],
                    'method' => $validated['method'],
                    'date' => $request->current_date
                ]);

            // If demo user, immediately deduct balance
         
                DB::table('users')
                    ->where('id', $userId)
                    ->decrement('balance', $validated['amount']);
            

            return response()->json([
                'success' => true,
                'message' => $existingWallet ? 'Withdrawal updated successfully' : 'Withdrawal added successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Withdrawal creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to process withdraw. Please try again.'
            ], 500);
        }
    }

}