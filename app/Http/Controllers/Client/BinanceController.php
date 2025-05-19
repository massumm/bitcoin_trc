<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BinanceController extends Controller
{
    private $apiKey;
    private $apiSecret;
    private $apiUrl = 'https://api.binance.com';

    public function __construct()
    {
        $this->apiKey = "BO2oZuCkkCcCYamyJtmnPBeij4OirflhhIYJlboeQKzqGwuH8pSBGIXCXf2pLJOr";
        $this->apiSecret = "0wZvlCDovUEYhBMZ8Qp3o1N4j5CHylK1nSOOeQyHCmaaojDkAh3AWwZU7jzvvDGs";
    }

    public function getDepositAddress(Request $request)
    {
        try {
            // Check if user is active
        

            // Validate the amount
            $request->validate([
                'amount' => 'required|numeric|min:10',
                'orderNumber' => 'required|string'
            ]);

            // Get current user's ID
            $userId = Auth::id();
            $user = Auth::user();
            $isDemo = $user->demostatus == 1;
<<<<<<< HEAD

=======
>>>>>>> 894b6a6dc11e837363966f6650b1a56d0dd722fe
            // Check for existing deposit with same order number and pending status
            

            // If no pending deposit, get a new address
            $lastUsedId = session('last_used_address_id', 0);
            
            $nextAddress = DB::table('deposit_address')
<<<<<<< HEAD
                ->where('id', '>', $lastUsedId)
                ->where('user_status', $isDemo ? 1 : 0)
                ->orderBy('id')
                ->first();

            if (!$nextAddress) {
                $nextAddress = DB::table('deposit_address')
                    ->where('user_status', $isDemo ? 1 : 0)
                    ->orderBy('id')
                    ->first();
            }
=======
            ->where('id', '>', $lastUsedId)
            ->where('user_status', $isDemo ? 1 : 0)
            ->orderBy('id')
            ->first();

        if (!$nextAddress) {
            $nextAddress = DB::table('deposit_address')
                ->where('user_status', $isDemo ? 1 : 0)
                ->orderBy('id')
                ->first();
        }
>>>>>>> 894b6a6dc11e837363966f6650b1a56d0dd722fe

            if ($nextAddress) {
                session(['last_used_address_id' => $nextAddress->id]);

                // Create a new deposit record
                DB::table('deposit')->insert([
                    'order_number' => $request->orderNumber,
                    'user_id' => $userId,
                    'user_name' => Auth::user()->name,
                    'trxid' => $nextAddress->address,
                    'amount' => $request->amount,
                    'status' => 'pending',
                    'date' => now(),
                    'image' => null
                ]);

                return response()->json([
                    'success' => true,
                    'hasPendingDeposit' => false,
                    'address' => $nextAddress->address,
                    'qrCode' => $this->generateQRCode($nextAddress->address),
                    'orderNumber' => $request->orderNumber,
                    'amount' => $request->amount
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No available deposit addresses found'
            ], 404);

        } catch (\Exception $e) {
            \Log::error('Deposit Address Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function fetchdeposit_info(){
        $userId = Auth::id();
        $existingDeposit = DB::table('deposit')
                ->where('user_id', $userId)
                ->where('status', 'pending')
                ->first();

            if ($existingDeposit) {
                return response()->json([
                    'success' => true,
                    'hasPendingDeposit' => true,
                    'pendingDeposit' => [
                        'orderNumber' => $existingDeposit->order_number,
                        'amount' => $existingDeposit->amount,
                        'address' => $existingDeposit->trxid,
                        'date' => $existingDeposit->date,
                        'qrCode'=>$this->generateQRCode($existingDeposit->trxid)
                    ]
                ]);
            }else{
                return response()->json([
                    'success' => true,
                    'hasPendingDeposit' => false,
                    'message' => 'No pending deposit found'
                ]);
            }   
    }
    private function generateQRCode($address)
    {
        // Using qrserver.com API for QR code generation
        $size = 150;
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size={$size}x{$size}&data=" . urlencode($address);
        return $qrUrl;
    }
} 