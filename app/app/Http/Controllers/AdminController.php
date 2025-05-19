<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\User2;
use Illuminate\Support\Facades\Auth;    


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
            $balance1 = $user->initial_balance;
            $demoStatus = $user->demostatus;
            Log::info('taskNumber:' .  $taskNumber . 'id:' . $id);
            $ammountmaker=$this->calculatAmount($balance, $taskNumber, $demoStatus,$balance1);
            Log::info('ammountmaker:' .  $ammountmaker );
            // Calculate target amount based on balance and task number
            $targetAmount = $this->calculateComboAmount($ammountmaker, $taskNumber, $demoStatus,$balance1);
            Log::info('targetAmount:' .  $targetAmount . 'demoStatus:' . $demoStatus. 'taskNumber:' . $taskNumber);
            // Calculate commission percentage
            $commissionPercentage = $this->calculateCommissionPercentage($demoStatus, $taskNumber);
            Log::info('commissionPercentage:' .  $commissionPercentage );

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
        Log::info('calculatAmount:' .  $balance . 'taskNumber:' . $taskNumber . 'demoStatus:' . $demoStatus);
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
           
           return $balance1+$additionalMultipliers;
        }elseif($demoStatus==2){
            if($taskNumber== 7){
                Log::info('balance101 ESOB KI :' .  $balance1 . 'taskNumber:' . $taskNumber . 'demoStatus:' . $demoStatus);

                if ($balance1 < 100) {
                    $additionalMultipliers = 4.51;
                } else {
                    $additionalMultipliers = 12.7332;
                }
                return $balance1+$additionalMultipliers;
            }elseif($taskNumber==17){
                if($balance1 < 100){
                    Log::info('balance101 :' .  $balance1 );
                    $previouscombo=$this->calculateComboAmount($balance1+4.51, 7, 2,$balance1);
                    Log::info('previouscombo:' .  $previouscombo );
                    $commissionPercentage00 = $this->calculateCommissionPercentage(2, 7);
                    $previosucommision=round($previouscombo * ($commissionPercentage00 / 100), 2);
                    $additionalMultipliers=15.4056+$previouscombo+$previosucommision;
                    Log::info('additionalMultipliers:' .  $additionalMultipliers );
                }else{
                    $previouscombo=$this->calculateComboAmount($balance1+12.7332, 7, 2,$balance1);
                    Log::info('previouscombo:' .  $previouscombo );
                    $commissionPercentage00 = $this->calculateCommissionPercentage(2, 7);
                    $previosucommision=round($previouscombo * ($commissionPercentage00 / 100), 2);
                    $additionalMultipliers=15.4056+$previouscombo+$previosucommision;
                }
                return $additionalMultipliers;
            }elseif($taskNumber==24){
                if($balance1 < 100){
                    Log::info('balance101 :' .  $balance1 );
                    $previouscombo=$this->calculateComboAmount($balance1+4.51,7, 2,$balance1);
                    $commissionPercentage00 = $this->calculateCommissionPercentage(2, 7);
                    $previosucommision=round($previouscombo * ($commissionPercentage00 / 100), 2);
                    $additionalMultipliers=15.4056+$previouscombo+$previosucommision;

                    $previouscombo=$this->calculateComboAmount($additionalMultipliers,17, 2,$balance1);
                    $commissionPercentage00 = $this->calculateCommissionPercentage(2, 17);
                    $previosucommision=round($previouscombo * ($commissionPercentage00 / 100), 2);
                    $additionalMultipliers=26.7332+$previouscombo+$previosucommision;

                }else{
                    $previouscombo=$this->calculateComboAmount($balance1+12.7332, 7, 2,$balance1);
                    $commissionPercentage00 = $this->calculateCommissionPercentage(2, 7);
                    $previosucommision=round($previouscombo * ($commissionPercentage00 / 100), 2);
                    $additionalMultipliers=15.4056+$previouscombo+$previosucommision;

                    $previouscombo=$this->calculateComboAmount($additionalMultipliers,17, 2,$balance1);
                    $commissionPercentage00 = $this->calculateCommissionPercentage(2, 17);
                    $previosucommision=round($previouscombo * ($commissionPercentage00 / 100), 2);
                    $additionalMultipliers=26.7332+$previouscombo+$previosucommision;


                }
                return $additionalMultipliers;
            }
           
        }elseif($demoStatus==3){ 
            $previous=0;
            if($taskNumber==5){
                $previous=$balance1+27.65;
                return $previous;
            }elseif($taskNumber==10){
                $previous=$this->calculateComboAmount($balance1+27.65, 5, 3,$balance1);
                $commissionPercentage00 = $this->calculateCommissionPercentage(3, 5);
                $previosucommision=round($previous * ($commissionPercentage00 / 100), 2);
                Log::info('previous:aihai ' .  $previous . 'commissionPercentage:' . $commissionPercentage00 . 'previosucommision:' . $previosucommision );
                $previous=$previous+86.19+$previosucommision;
                return $previous;
            }elseif($taskNumber==18){
                //for ammount making 5
                $previous=$this->calculateComboAmount($balance1+27.65, 5, 3,$balance1);
                $commissionPercentage00 = $this->calculateCommissionPercentage(3, 5);
                $previosucommision=round($previous * ($commissionPercentage00 / 100), 2);
                $previousammount=$previous+86.19+$previosucommision;
                //for ammount making 10
                $previouscombo=$this->calculateComboAmount($previousammount, 10, 3,$balance1);
                $commissionPercentage11 = $this->calculateCommissionPercentage(3, 10);
                $previosucommision=round($previouscombo * ($commissionPercentage11 / 100), 2);
                return $previouscombo+65.88+$previosucommision;
            }elseif($taskNumber==23){
                //for ammount making 5
                $previous=$this->calculateComboAmount($balance1+27.65, 5, 3,$balance1);
                $commissionPercentage00 = $this->calculateCommissionPercentage(3, 5);
                $previosucommision=round($previous * ($commissionPercentage00 / 100), 2);
                $previousammount=$previous+86.19+$previosucommision;
                //for ammount making 10 
                $previouscombofor5=$this->calculateComboAmount($previousammount, 10, 3,$balance1);
                $commissionPercentage11 = $this->calculateCommissionPercentage(3, 10);
                $previosucommision=round($previouscombofor5 * ($commissionPercentage11 / 100), 2);
                $previouscombofor5=$previouscombofor5+65.88+$previosucommision;
                //for ammount making 18
                $previouscombofor18=$this->calculateComboAmount($previouscombofor5, 18, 3,$balance1);
                $commissionPercentage23 = $this->calculateCommissionPercentage(3, 18);
                $previosucommision=round($previouscombofor18 * ($commissionPercentage23 / 100), 2);
                $previouscombofor18=$previouscombofor18+986.19+$previosucommision;
                //for ammount making 25

                
                return $previouscombofor18;
            }elseif($taskNumber==25){

                $previous=$this->calculateComboAmount($balance1+27.65, 5, 3,$balance1);
                $commissionPercentage00 = $this->calculateCommissionPercentage(3, 5);
                $previosucommision=round($previous * ($commissionPercentage00 / 100), 2);
                $previousammount=$previous+86.19+$previosucommision;
                //for ammount making 10 
                $previouscombofor5=$this->calculateComboAmount($previousammount, 10, 3,$balance1);
                $commissionPercentage11 = $this->calculateCommissionPercentage(3, 10);
                $previosucommision=round($previouscombofor5 * ($commissionPercentage11 / 100), 2);
                $previouscombofor5=$previouscombofor5+65.88+$previosucommision;
                //for ammount making 18
                $previouscombofor18=$this->calculateComboAmount($previouscombofor5, 18, 3,$balance1);
                $commissionPercentage23 = $this->calculateCommissionPercentage(3, 18);
                $previosucommision=round($previouscombofor18 * ($commissionPercentage23 / 100), 2);
                $previouscombofor18=$previouscombofor18+986.19+$previosucommision;
//for ammount making 23
                $previouscombofor23=$this->calculateComboAmount($previouscombofor18, 23, 3,$balance1);
                $commissionPercentage25 = $this->calculateCommissionPercentage(3, 23);
                $previosucommision=round($previouscombofor23 * ($commissionPercentage25 / 100), 2);
                $previouscombofor25=$previouscombofor23+1298.72+$previosucommision;

                return $previouscombofor25;
            }   
        }
    }   
    
    private function calculateComboAmount($balance, $taskNumber, $demoStatus,$balance1)
    {
        Log::info(' calulate combo  :' .  $balance1 . 'balance:' . $balance. 'taskNumber:' . $taskNumber . 'demoStatus:' . $demoStatus);
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
               
                    $multipliers = [20 => 17];
                    return round($balance + $multipliers[20], 2);
               
            } elseif ($demoStatus == 2) {
            

            if ($balance1 < 100) {
                $multipliers = [
                    7 =>38,    // accurate from your task 7 data
                    17 => 58,   // accurate from task 17
                    24 => 98    // accurate from task 24
                ];
              
            }elseif($balance1 <= 30)    {
                $multipliers = [
                    7 =>31,    // accurate from your task 7 data
                    17 => 55,   // accurate from task 17
                    24 => 98    // accurate from task 24
                ];
            }else{
                $multipliers = [
                    7 =>37,    // accurate from your task 7 data
                    17 => 55,   // accurate from task 17
                    24 => 81    // accurate from task 24
                ];
            }
            Log::info('multipliers:' .  $multipliers[$taskNumber] . 'balance:'.$balance);

                return round($balance + $multipliers[$taskNumber], 2);
            } elseif ($demoStatus == 3) {
                $multipliers = [
                    5 => 151,
                    10 => 412.86,
                    18 => 917.7434,
                    23 => 2646.332,
                    25 => 14906.1576,
                ];
                if (!isset($multipliers[$taskNumber])) {
                    return 0;
                }
                $multiplier = $multipliers[$taskNumber];
                \Log::info('under multi default:' .  $multiplier. 'balance:'.$balance);
                return round($balance + $multiplier, 2);
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
            Log::info('taskNumber: 3333 ' .  $taskNumber . 'demoStatus:' . $demoStatus);
                if($taskNumber==5){
                    return 20;
                }elseif($taskNumber==10){
                    return 25;
                }elseif($taskNumber==18){
                    return 40;
                }elseif($taskNumber==23){
                    return 80;
                }elseif($taskNumber==25){
                    return 80;
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
