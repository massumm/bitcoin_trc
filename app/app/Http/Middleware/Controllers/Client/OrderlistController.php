<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

class OrderlistController extends Controller
{
    public function getRandomProducts(Request $request)
    {
        try {

            $projectId = $request->query('projectId');
            $user = Auth::user();
            $balance = $user->balance;
            $taskNumber = Auth::user()->today_task+1 ;
            $demostatus=  Auth::user()->demostatus;
            $productController = new ProductController();


            // Define combo task numbers based on demostatus
            $comboTaskNumbers = [];
            if ($demostatus == 0) {
                $comboTaskNumbers = [20];
            } else if ($demostatus == 1) {
                $comboTaskNumbers = [7, 17, 24];
            } else if ($demostatus == 2) {
                $comboTaskNumbers = [7, 17, 24];
            } else if ($demostatus == 3) {
                $comboTaskNumbers = [5, 10, 18, 23, 25];
            } else {
                // Default combo task numbers if demostatus is not set
                $comboTaskNumbers = [7, 17, 24];
            }

            // Debug information
            \Log::info('Task Number: ' . $taskNumber);
            \Log::info('Demo Status: ' . $demostatus);
            \Log::info('Combo Task Numbers: ' . json_encode($comboTaskNumbers));
            
            $isCombo = in_array((int)$taskNumber, $comboTaskNumbers);
            \Log::info('Is Combo: ' . ($isCombo ? 'true' : 'false'));
            
            // Get target amount based on balance
            $targetAmount = $isCombo
            ? $this->getComboOrderTotal($balance, $taskNumber,$demostatus)
            : $this->getOrderAmountByBalance($balance, $taskNumber,$demostatus);
            \Log::info('target ammount: ' .$targetAmount);
            if ($isCombo) {
                // First check if combo exists for this user and task
                $existingCombo = DB::table('combos')
                    ->where('user_id', $user->id)
                    ->where('task_number', $taskNumber)
                    ->first();

                if ($existingCombo) {
                    // Use existing combo data
                    $comboProducts = json_decode($existingCombo->products, true);
                    $actualAmount = 0;
                    $commission = $existingCombo->commission;
                    foreach ($comboProducts as $product) {
                        $actualAmount += floatval($product['price']) * intval($product['quantity']);
                    }
                    $commissionAmount = round($actualAmount * ($commission / 100), 2);
                    \Log::info('actual amount: ' . $actualAmount);
                    
                    return response()->json([
                        'success' => true,
                        'combo' => true,
                        'products' => $comboProducts,
                        'total_amount' => $actualAmount,
                        'commission' => $commissionAmount
                    ]);
                }

                // If no existing combo, generate new one
              
                
                // Get products with target amount
                $response = $productController->generateProductsWithTargetAmount($targetAmount);
                \Log::info('response: ' . json_encode($response));
                
                // Get the response data
                $responseData = $response->getData();
                $comboProducts = $responseData->products;
                $actualAmount = $responseData->total_amount;
                
                // Calculate commission
                if($demostatus==1){
                    $commissionPercentage = $this->getcomboCommissionPercentage($projectId);
                }elseif($demostatus==0){
                    $commissionPercentage=17;
                }elseif($demostatus==2){
                    if($taskNumber==7){
                        $commissionPercentage=16;
                    }elseif($taskNumber==17){
                        $commissionPercentage=18;
                    }else{
                        $commissionPercentage=20;
                    }
                }elseif($demostatus==3){
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
               
                $commission = round($actualAmount * ($commissionPercentage / 100), 2);
    
                // Format products for response
                $formattedProducts = array_map(function($product) {
                    return [
                        'id' => $product->product_id,
                        'title' => $product->title,
                        'price' => $product->price,
                        'quantity' => $product->quantity,
                        'image' => $product->image,
                        'amount' => $product->amount
                    ];
                }, $comboProducts);
    
                return response()->json([
                    'success' => true,
                    'combo' => true,
                    'products' => $formattedProducts,
                    'total_amount' => $actualAmount,
                    'commission' => $commission
                ]);
            }
    
        

           
            // Get random product
            $product = DB::table('products')->inRandomOrder()->limit(1)->first();
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'No products available'
                ], 404);
            }

            // Calculate quantity based on target amount
            $price = $product->price;
            if($price > $balance){
                \Log::info('price is higher: '.$price);
                // If product price is greater than balance, set a random lower price
                // Random price between 10% and 90% of the user's balance
                $minPrice = $balance * 0.1;
                $maxPrice = $balance * 0.9;
                $price = round(mt_rand($minPrice * 100, $maxPrice * 100) / 100, 2);
            }

            if($demostatus != 1) {
                // $response22 = $productController->generatenormalProductsWithTargetAmount($targetAmount);
                // \Log::info('response22: ' . json_encode($response22));
                // For demostatus 0, 2, 3 - ensure exact amount match
                $quantity = max(1, ceil($targetAmount / $price));
                $actualAmount = $targetAmount; // Use the exact target amount
            } else {
            
                // For demostatus 1 - use existing logic
                $quantity = max(1, floor($targetAmount / $price));
                $actualAmount = round($price * $quantity, 2);
            }
            
            // Calculate commission based on project ID
            $commissionPercentage = $this->getCommissionPercentage($projectId);
            $commission = round($actualAmount * ($commissionPercentage / 100), 2);

            return response()->json([
                'success' => true,
                'products' => [[
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $price,
                    'quantity' => $quantity,
                    'image' => $product->image
                ]],
                'total_amount' => $actualAmount,
                'commission' => $commission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching products: ' . $e->getMessage()
            ], 500);
        }
    }
    private function randomSplit($total, $parts)
{
    $values = [];
    $sum = 0;

    for ($i = 0; $i < $parts; $i++) {
        $rand = rand(80, 120); // Random weight
        $values[] = $rand;
        $sum += $rand;
    }

    return array_map(function ($val) use ($total, $sum) {
        return round(($val / $sum) * $total, 2);
    }, $values);
}

    private function getComboOrderTotal($balance, $taskNumber,$demostatus)
    {
      if($demostatus==1){
        if ($balance <= 50) {
            \Log::info('under combo 50:');
            $multipliers = [
                7 => [1.42, 1.48],      // existing
                17 => [1.34, 1.38],     // existing
                24 => [1.27, 1.30]      // existing
            ];
        } else {
            \Log::info('under combo default:');
            $multipliers = [
                7 => [1.42, 1.48],      // existing
                17 => [1.48, 1.52],     // existing
                24 => [1.30, 1.31]      // existing
            ];
        }
        
          if (!isset($multipliers[$taskNumber])) {
            return 0;
        }
    
        [$min, $max] = $multipliers[$taskNumber];
        $multiplier = mt_rand($min * 10000, $max * 10000) / 10000;
        \Log::info('under multi default:' .  $multiplier );
        return round($balance * $multiplier, 2);
      }else{

        if($demostatus==0){
            if($balance <= 40){
                $multipliers = [
                    20 => [
                        1.37, 1.39]
                ];
            }elseif($balance <= 50){
                $multipliers = [
                    20 => [1.37, 1.39]
                ];
            }elseif($balance <= 60){
                $multipliers = [
                    20 => [1.37, 1.39]
                ];
            }else{
                $multipliers = [20 => [1.37, 1.39]];
            }
        }elseif($demostatus==2){


            if ($balance <= 543) {
                $multipliers = [
                    7 => [2.00, 2.05],    // accurate from your task 7 data
                    17 => [1.60, 1.70],   // accurate from task 17
                    24 => [1.35, 1.40]    // accurate from task 24
                ];
            }else{
                $multipliers = [
                    7 => [1.60, 1.70],    // accurate from your task 7 data
                    17 => [1.50, 1.56],   // accurate from task 17
                    24 => [1.30, 1.32]    // accurate from task 24
                ];
            }
        

        }elseif($demostatus==3){
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
                \Log::info('under multi default:' .  $multiplier );
                return round($balance + $multiplier, 2);
        
    }
  
    
        if (!isset($multipliers[$taskNumber])) {
            return 0;
        }
    
        [$min, $max] = $multipliers[$taskNumber];
        $multiplier = mt_rand($min * 10000, $max * 10000) / 10000;
        \Log::info('under multi default:' .  $multiplier );
        return round($balance * $multiplier, 2);
    }
}

    private function getOrderAmountByBalance($balance, $taskNumber,$demostatus)
    {
        if($demostatus !=1){
            $json = storage_path('app/user_task_multipliers.json');
            $data = json_decode(file_get_contents($json), true);

            if($demostatus==0){
                if ($balance <= 250) {
                    $tier = 'fixed';
                } 
            }elseif($demostatus==2){
                $tier = 'fixed1';
            }elseif($demostatus==3){
                $tier = 'fixed2';
                $fixedValue = $data[$tier][$taskNumber] * $balance;
                \Log::info("Using fixed value $fixedValue for task $taskNumber in $tier tier");
                return $fixedValue;
            }

            if (!isset($data[$tier][$taskNumber])) {
                \Log::warning("Multiplier not found for task $taskNumber in $tier tier");
                return 0;
            }

            // Get the fixed value from JSON
            $fixedValue = $data[$tier][$taskNumber];
            \Log::info("Using fixed value $fixedValue for task $taskNumber in $tier tier");
            return $fixedValue;
        }else{
            $json = storage_path('app/task_multipliers.json');
            $data = json_decode(file_get_contents($json), true);

            if ($balance <= 50) {
                $tier = 'low';
            } elseif ($balance <= 500) {
                $tier = 'medium';
            } else {
                $tier = 'high';
            }

            if (!isset($data[$tier][$taskNumber])) {
                \Log::warning("Multiplier not found for task $taskNumber in $tier tier");
                return 0;
            }

            [$min, $max] = $data[$tier][$taskNumber];
            $multiplier = mt_rand($min * 10000, $max * 10000) / 10000;
            return round($balance * $multiplier, 2);
        }
    }

    private function getCommissionPercentage($projectId)
    {
        switch ($projectId) {
            case 1:
                return 4;
            case 2:
                return 8;
            case 3:
                return 12;
            default:
                return 4;
        }
    }

    private function getcomboCommissionPercentage($projectId)
    {
        switch ($projectId) {
            case 1:
                return 17;
            case 2:
                return 15;
            case 3:
                return 18;
            default:
                return 15;
        }
    }

    function submitOrder(Request $request)
    {
        try {
            // Validate required fields
            $validator = \Validator::make($request->all(), [
                'order_number' => 'required|string',
                'total_amount' => 'required|numeric|min:0',
                'commission' => 'required|numeric|min:0',
                'order_items' => 'required|array|min:1',
                'order_items.*.product_id' => 'required|string',
                'order_items.*.quantity' => 'required|integer|min:1',
                'order_items.*.price' => 'required|numeric|min:0',
                'order_items.*.name' => 'required|string',
                'order_items.*.image' => 'required|string'
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
        
            $user = Auth::user();
            $isInsufficientBalance = $user->balance < $request->total_amount;
        
            DB::beginTransaction();
        
            // Check if the order number already exists in the orders table
            $existingOrder = DB::table('orders')->where('order_number', $request->order_number)->first();
        
            if ($existingOrder) {
                // If the order exists, update it
                DB::table('orders')->where('order_number', $request->order_number)->update([
                    'total_amount' => $request->total_amount,
                    'commission' => $request->commission,
                    'expected_income' => $request->expected_income,
                    'status' => $isInsufficientBalance ? 'pending' : 'completed',
                    'updated_at' => now(),
                ]);
        
                // Delete the existing order items before inserting new ones
                DB::table('order_items')->where('order_id', $existingOrder->id)->delete();
        
                // Insert new order items
                foreach ($request->order_items as $item) {
                    DB::table('order_items')->insert([
                        'order_id' => $existingOrder->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'image' => $item['image'],
                        'price' => $item['price'],
                        'name' => $item['name']
                    ]);
                }
            } else {
                // If the order does not exist, create a new order
                $orderId = DB::table('orders')->insertGetId([
                    'order_number' => $request->order_number,
                    'user_id' => $user->id,
                    'total_amount' => $request->total_amount,
                    'commission' => $request->commission,
                    'expected_income' => $request->expected_income,
                    'status' => $isInsufficientBalance ? 'pending' : 'completed',
                    'created_at' => now()
                ]);
        
                // Insert order items
                foreach ($request->order_items as $item) {
                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'image' => $item['image'],
                        'price' => $item['price'],
                        'name' => $item['name']
                    ]);
                }
            }
        
            if ($isInsufficientBalance) {
                $needBalance = number_format($request->total_amount - $user->balance, 2, '.', '');
                // Update user status to 2 (Restricted)
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['status' => "2",
                    'cash_gap'=>$needBalance
                
                ]);
        
                DB::commit();
        
                
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient balance, you need to top up $needBalance USDT",
                    'need_balance' => $needBalance
                ]);
            }
    
        
            // If balance is sufficient, update user stats
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    

                    'status' => DB::raw('CASE WHEN today_task + 1 >= 25 THEN "0" ELSE "1" END'),
                    'today_task' => DB::raw('CASE WHEN today_task + 1 >= 25 THEN today_task+1 ELSE today_task + 1 END'),
                    'min_earn' => DB::raw('min_earn + ' . $request->commission),
                    'balance' => DB::raw('balance + ' . $request->commission),
                    'cash_gap'=>0,
                    'demostatus' => DB::raw('
            CASE
                WHEN today_task  >= 25 THEN
                    CASE
                        WHEN demostatus = 0 THEN 2
                        WHEN demostatus = 2 THEN 3
                        ELSE demostatus
                    END
                ELSE demostatus
            END
        ')

                ]);
            
            // Delete the generated combo for this user after order submission
            DB::table('combos')
                ->where('task_number', $user->today_task + 1)
                ->where('user_id', $user->id)
                ->delete();
        
            DB::commit();
        
            return response()->json([
                'success' => true,
                'message' => 'Order submitted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit order. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
        
    }
    

    public function getOrders(Request $request)
    {
        try {
            $status = $request->query('status', 'pending');
            
            $orders = DB::table('orders')
                ->where('user_id', Auth::id())
                ->where('status', $status)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($order) {
                    $orderItems = DB::table('order_items')
                        ->where('order_id', $order->id)
                        ->get();
                    
                    return [
                        'order_number' => $order->order_number,
                        'total_amount' => $order->total_amount,
                        'commission' => $order->commission,
                        'expected_income' => $order->expected_income,
                        'created_at' => $order->created_at,
                        'products' => $orderItems->map(function ($item) {
                            return [
                                'id' => $item->product_id,
                                'image' => $item->image,
                                'price' => $item->price,
                                'quantity' => $item->quantity,
                                'name' => $item->name
                            ];
                        })
                    ];
                });

            return response()->json([
                'success' => true,
                'orders' => $orders
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch orders'
            ], 500);
        }
    }

    public function closeOrder(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'order_number' => 'required|string',
                'total_amount' => 'required|numeric|min:0',
                'commission' => 'required|numeric|min:0',
                'expected_income' => 'required|numeric|min:0',
                'order_items' => 'required|array|min:1',
                'order_items.*.product_id' => 'required|string',
                'order_items.*.name' => 'required|string',
                'order_items.*.price' => 'required|numeric|min:0',
                'order_items.*.quantity' => 'required|integer|min:1',
                'order_items.*.image' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            DB::beginTransaction();

            try {
                // Check if order with this number already exists
                $existingOrder = DB::table('orders')
                    ->where('order_number', $request->order_number)
                    ->first();

                if ($existingOrder) {
                    // Update existing order
                    DB::table('orders')
                        ->where('id', $existingOrder->id)
                        ->update([
                            'total_amount' => $request->total_amount,
                            'commission' => $request->commission,
                            'expected_income' => $request->expected_income,
                            'status' => 'pending',
                            'updated_at' => now()
                        ]);

                    // Delete existing order items
                    DB::table('order_items')
                        ->where('order_id', $existingOrder->id)
                        ->delete();

                    $orderId = $existingOrder->id;
                } else {
                    // Create new order
                    $orderId = DB::table('orders')->insertGetId([
                        'order_number' => $request->order_number,
                        'user_id' => $user->id,
                        'total_amount' => $request->total_amount,
                        'commission' => $request->commission,
                        'expected_income' => $request->expected_income,
                        'status' => 'pending',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
        
                // Insert order items
                foreach ($request->order_items as $item) {
                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'image' => $item['image'],
                        'price' => $item['price'],
                        'name' => $item['name']
                    ]);
                }

                // Update user status and task count
                DB::table('users')
                ->where('id', $user->id)
                ->update(['status' => "2"]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => $existingOrder ? 'Order updated successfully' : 'Order created successfully',
                    'order_id' => $orderId
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
