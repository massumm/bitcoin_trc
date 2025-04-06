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

    public function getDepositAddress()
    {
        try {
            // Get current user's ID
            $userId = Auth::id();

            // Check for pending deposits
            $pendingDeposit = DB::table('deposit')
                ->where('user_id', $userId)
                ->where('status', 'pending')
                ->first();

            if ($pendingDeposit) {
                return response()->json([
                    'success' => true,
                    'hasPendingDeposit' => true,
                    'pendingDeposit' => [
                        'orderNumber' => $pendingDeposit->order_number,
                        'amount' => $pendingDeposit->amount,
                        'address' => $pendingDeposit->trxid,
                        'date' => $pendingDeposit->date
                    ]
                ]);
            }

            // If no pending deposit, get a new address
            $lastUsedId = session('last_used_address_id', 0);
            
            $nextAddress = DB::table('deposit_address')
                ->where('id', '>', $lastUsedId)
                ->where('user_status', 0)
                ->orderBy('id')
                ->first();

            if (!$nextAddress) {
                $nextAddress = DB::table('deposit_address')
                    ->where('user_status', 0)
                    ->orderBy('id')
                    ->first();
            }

            if ($nextAddress) {
                session(['last_used_address_id' => $nextAddress->id]);

                return response()->json([
                    'success' => true,
                    'hasPendingDeposit' => false,
                    'address' => $nextAddress->address,
                    'qrCode' => $this->generateQRCode($nextAddress->address)
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

    private function generateQRCode($address)
    {
        // Using qrserver.com API for QR code generation
        $size = 150;
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size={$size}x{$size}&data=" . urlencode($address);
        return $qrUrl;
    }
} 