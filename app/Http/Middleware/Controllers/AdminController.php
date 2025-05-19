<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\User2;

class AdminController extends Controller
{
    public function getComboProducts($taskNumber, $id)
    {
        try {
            // Get user details
            $user = DB::table('users')->where('id', $id)->first();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Get user's balance and demo status
            $balance = $user->balance;
            $demoStatus = $user->demostatus;
            $balance1 = $user->initial_balance;
            $ammountmaker=$this->calculatAmount($balance, $taskNumber, $demoStatus,$balance1);

            // Calculate target amount based on balance and task number
            $targetAmount = $this->calculateComboAmount($ammountmaker, $taskNumber, $demoStatus,$balance1);

            // Calculate commission percentage
            $commissionPercentage = $this->calculateCommissionPercentage($demoStatus, $taskNumber);

            // Initialize ProductController
            $productController = new ProductController();
            
            // Generate products with target amount
            $response = $productController->generateProductsWithTargetAmount($targetAmount);

            // Add task number and commission to response
            $responseData = $response->getData(true);
            $responseData['task_number'] = $taskNumber;
            $responseData['target_amount'] = $targetAmount;
            $responseData['commission_percentage'] = $commissionPercentage;
            $responseData['commission_amount'] = round($targetAmount * ($commissionPercentage / 100), 2);
            $responseData['short_balance'] = $ammountmaker;

            return response()->json($responseData);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating combo products: ' . $e->getMessage()
            ], 500);
        }
    }
    private function calculatAmount($balance, $taskNumber, $demoStatus,$balance1)
    {
                $multipliers = [];
        $additionalMultipliers = 0;
        $commission = 0;
       
       
        if ($demoStatus == 0) { 
            if($balance<=499){
                $additionalMultipliers=19.862;
            }elseif($balance>499 && $balance<=899){
                $additionalMultipliers=32.8844;
            }elseif($balance>899){
                $additionalMultipliers=44.9156;
            }
           
           return $balance+$additionalMultipliers;
        }elseif($demoStatus==2){
            if($taskNumber==7   ){
                if($balance1 <=99){
                    $additionalMultipliers=4.51;
                }elseif($balance1>99){
                    $additionalMultipliers=12.7332;
                }
                return $balance+$additionalMultipliers;
            }elseif($taskNumber==17){
                if($balance1<99){
                    Log::info('Calculating a gua mara'.$balance1);
                    $previouscombo=$this->calculateComboAmount($balance1+4.51, 7, 2);
                    $additionalMultipliers=15.4056+$previouscombo;
                    Log::info('Calculating a gua mara'.$additionalMultipliers);
                }elseif($balance1>99 && $balance1<=299){
                    $previouscombo=$this->calculateComboAmount($balance+26.7332, 7, 2);
                    $additionalMultipliers=30.8112+26.7332+$previouscombo;
                }
                return $balance+$additionalMultipliers;
            }elseif($taskNumber==24){
                if($balance<=499){
                    $previouscombo=$this->calculateComboAmount($balance+15.4056, 7, 2);
                    $additionalMultipliers=23.6972+15.4056+$previouscombo;
                }elseif($balance>499 && $balance<=899){
                    $previouscombo=$this->calculateComboAmount($balance+30.8112, 17, 2);
                    $additionalMultipliers=47.3944+30.8112+$previouscombo;
                }elseif($balance>899){
                    $previouscombo=$this->calculateComboAmount($balance+46.2168, 17, 2);
                    $additionalMultipliers=71.0916+46.2168+$previouscombo;
                }
                return $balance+$additionalMultipliers;
            }
           
        }elseif($demoStatus==3){    
        
            if($taskNumber==5){
                Log::info('Calculating a gua mara');
                return $balance*1.3;
            }elseif($taskNumber==10){
                return $balance*12.5;
            }elseif($taskNumber==18){
                return $balance*42;
            }elseif($taskNumber==23){
                return $balance*162;
            }elseif($taskNumber==25){
                return $balance*586;
            }   
        }
    }   
    
    private function calculateComboAmount($balance, $taskNumber, $demoStatus)
    {
        $multipliers = [];

        if ($demoStatus == 1) {
            if ($balance <= 50) {
                $multipliers = [
                    7 => [1.42, 1.48],
                    17 => [1.34, 1.38],
                    24 => [1.27, 1.30]
                ];
            } else {
                $multipliers = [
                    7 => [1.42, 1.48],
                    17 => [1.48, 1.52],
                    24 => [1.44, 1.50]
                ];
            }
        } else {
            if ($demoStatus == 0) {
                if ($balance <= 40) {
                    $multipliers = [20 => [1.37, 1.39]];
                } elseif ($balance <= 50) {
                    $multipliers = [20 => [1.37, 1.39]];
                } elseif ($balance <= 60) {
                    $multipliers = [20 => [1.37, 1.39]];
                } else {
                    $multipliers = [20 => [1.37, 1.39]];
                }
            } elseif ($demoStatus == 2) {
                if ($balance <= 543) {
                    $multipliers = [
                        7 => [2.00, 2.05],
                        17 => [1.60, 1.70],
                        24 => [1.35, 1.40]
                    ];
                } else {
                    $multipliers = [
                        7 => [2.00, 2.05],
                        17 => [1.60, 1.70],
                        24 => [1.35, 1.40]
                    ];
                }
            } elseif ($demoStatus == 3) {
                $multipliers = [
                    5 => [7.00, 7.05],
                    10 => [2.68, 2.70],
                    18 => [2.02, 2.05],
                    23 => [1.80, 1.85],
                    25 => [2.02, 2.05],
                ];
            }
        }

        if (!isset($multipliers[$taskNumber])) {
            return 0;
        }

        [$min, $max] = $multipliers[$taskNumber];
        $multiplier = mt_rand($min * 10000, $max * 10000) / 10000;
        
        return round($balance * $multiplier, 2);
    }

    private function calculateCommissionPercentage($demoStatus, $taskNumber)
    {
        if ($demoStatus == 0) {
            return 17;
        } elseif ($demoStatus == 2) {
            if ($taskNumber == 7) {
                return 16;
            } elseif ($taskNumber == 17) {
                return 18;
            } else {
                return 20;
            }
        }elseif($demoStatus==3){
                if($taskNumber==5){
                    $commissionPercentage=20;
                }elseif($taskNumber==10){
                    $commissionPercentage=25;
                }elseif($taskNumber==18){
                    $commissionPercentage=40;
                }elseif($taskNumber==23){
                    $commissionPercentage=80;
                }elseif($taskNumber==25){
                    $commissionPercentage=80;
                }
            }
        // Default commission percentage if no specific rule matches
        return 20;
    }

    public function updateWithdrawStatus($id, $status)
    {
        try {
            $user = User::findOrFail($id);
            $user->withdraw_status = $status;
            $user->save();

            return redirect()->back()->with('status', 'Withdraw status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update withdraw status');
        }
    }

    public function updateDemoStatus($id, $status)
    {
        try {
            Log::info('Updating demo status for user ID: ' . $id . ' to status: ' . $status);
            $user = User2::findOrFail($id);
            $user->demostatus = $status;
            $user->save();

            return redirect()->back()->with('status', 'Client role updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update client role');
        }
    }

    public function todays_checker($userId)
    {
        try {
            // Get the user
            $user = User2::findOrFail($userId);
            
            // Get today's date in Y-m-d format
            $today = date('Y-m-d');
            
            // Check if user's updated_at date matches today
            $userUpdatedDate = date('Y-m-d', strtotime($user->updated_at));
            
            if ($userUpdatedDate !== $today) {
                // Store current min_earn to miss_earn
                $missEarn = $user->min_earn;
                
                // Update user's min_earn to 0 and miss_earn
                $user->update([
                    'min_earn' => 0,
                    'yesterday_comm' => $missEarn
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'User earnings updated successfully',
                    'data' => [
                        'previous_min_earn' => $missEarn,
                        'new_min_earn' => 0
                    ]
                ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'No update needed - user already updated today',
                'data' => [
                    'min_earn' => $user->min_earn,
                    'yesterday_comm' => $user->yesterday_comm
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check/update user earnings',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
