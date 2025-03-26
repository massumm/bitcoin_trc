<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            $timestamp = round(microtime(true) * 1000);
            $params = [
                'coin' => 'USDT',
                'network' => 'TRX',
                'timestamp' => $timestamp
            ];
            
            // Sort parameters alphabetically
            ksort($params);
            
            // Create query string
            $queryString = http_build_query($params);
            
            // Generate signature
            $signature = hash_hmac('sha256', $queryString, $this->apiSecret);
            
            // Add signature to parameters
            $params['signature'] = $signature;
            
            // Make API request
            $response = Http::withHeaders([
                'X-MBX-APIKEY' => $this->apiKey
            ])->get("{$this->apiUrl}/sapi/v1/capital/deposit/address", $params);

            \Log::info('Binance API Response:', [
                'status' => $response->status(),
                'body' => $response->body(),
                'url' => $response->effectiveUri()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['address'])) {
                    return response()->json([
                        'success' => true,
                        'address' => $data['address'],
                        'qrCode' => $this->generateQRCode($data['address'])
                    ]);
                }
            }

            // If we reach here, something went wrong
            $errorMessage = $response->json()['msg'] ?? 'Failed to fetch deposit address';
            \Log::error('Binance API Error:', [
                'response' => $response->json(),
                'status' => $response->status()
            ]);

            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ], 400);

        } catch (\Exception $e) {
            \Log::error('Binance API Exception:', [
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