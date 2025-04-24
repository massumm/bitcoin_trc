<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

            // Define combo task numbers based on demostatus
            $comboTaskNumbers = [];
            if ($demostatus == 0) {
                $comboTaskNumbers = [20];
            } else if ($demostatus == 1) {
                $comboTaskNumbers = [7, 18, 24];
            } else if ($demostatus == 2) {
                $comboTaskNumbers = [10, 22, 24];
            } else if ($demostatus == 3) {
                $comboTaskNumbers = [7, 10, 12, 20, 24];
            } else {
                // Default combo task numbers if demostatus is not set
                $comboTaskNumbers = [7, 18, 24];
            }

            // Debug information
            \Log::info('Task Number: ' . $taskNumber);
            \Log::info('Demo Status: ' . $demostatus);
            \Log::info('Combo Task Numbers: ' . json_encode($comboTaskNumbers));
            
            $isCombo = in_array((int)$taskNumber, $comboTaskNumbers);
            \Log::info('Is Combo: ' . ($isCombo ? 'true' : 'false'));
            
            // Get target amount based on balance
            $targetAmount = $isCombo
            ? $this->getComboOrderTotal($balance, $taskNumber)
            : $this->getOrderAmountByBalance($balance, $taskNumber);
            \Log::info('target ammount: ' .$targetAmount);
            if ($isCombo) {
                // Get 5 random products
                $products = DB::table('products')->inRandomOrder()->limit(5)->get();
    
                if ($products->count() < 5) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Not enough products for combo order'
                    ], 404);
                }
    
                // Split the target amount among 5 products with randomness
                $splitAmounts = $this->randomSplit($targetAmount, 5);
    
                $comboProducts = [];
                $actualAmount = 0;
    
                foreach ($products as $index => $product) {
                    $price = $product->price;
    
                    // At least 1 quantity
                    $quantity = max(1, floor($splitAmounts[$index] / $price));
                    $amount = round($price * $quantity, 2);
                    $actualAmount += $amount;
    
                    $comboProducts[] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $price,
                        'quantity' => $quantity,
                        'image' => $product->image
                    ];
                }
    
                // Calculate commission
                $commissionPercentage = $this->getcomboCommissionPercentage($projectId);
                $commission = round($actualAmount * ($commissionPercentage / 100), 2);
    
                return response()->json([
                    'success' => true,
                    'combo' => true,
                    'products' => $comboProducts,
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
            $quantity = floor($targetAmount / $price);
            
            // Ensure minimum quantity of 1
            $quantity = max(1, $quantity);
            
            // Calculate actual amount
            $actualAmount = round($price * $quantity, 2);

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

    private function getComboOrderTotal($balance, $taskNumber)
    {
      

    if ($balance <= 50) {
        \Log::info('under combo 50:');
        $multipliers = [
            5 => [1.30, 1.34],
            7 => [1.42, 1.48],      // existing
            8 => [1.22, 1.26],
            11 => [1.25, 1.28],
            14 => [1.24, 1.28],
            17 => [1.20, 1.24],
            18 => [1.34, 1.38],     // existing
            19 => [1.28, 1.32],
            20 => [1.26, 1.30],
            22 => [1.29, 1.33],
            23 => [1.26, 1.29],
            24 => [1.27, 1.30]      // existing
        ];
    } else {
        \Log::info('under combo default:');
        $multipliers = [
            5 => [1.38, 1.42],
            7 => [1.42, 1.48],      // existing
            8 => [1.32, 1.36],
            11 => [1.35, 1.38],
            14 => [1.34, 1.38],
            17 => [1.30, 1.34],
            18 => [1.48, 1.52],     // existing
            19 => [1.39, 1.43],
            20 => [1.36, 1.40],
            22 => [1.40, 1.44],
            23 => [1.35, 1.38],
            24 => [1.44, 1.50]      // existing
        ];
    }
    
        if (!isset($multipliers[$taskNumber])) {
            return 0;
        }
    
        [$min, $max] = $multipliers[$taskNumber];
        $multiplier = mt_rand($min * 10000, $max * 10000) / 10000;
    
        return round($balance * $multiplier, 2);
    }

    private function getOrderAmountByBalance($balance, $taskNumber)
{
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




    
    // private function getOrderAmountByBalance($balance,$taskNumber)
    // {
    //     // if ($balance <= 100) {
    //     //     // Random between 20% to 35%
    //     //     $percentage = mt_rand(2000, 3500) / 10000; // 0.20 to 0.35
    //     // } elseif ($balance <= 400) {
    //     //     // Random between 60% to 75%
    //     //     $percentage = mt_rand(6000, 7500) / 10000; // 0.60 to 0.75
    //     // } else {
    //     //     // Random between 15% to 25%
    //     //     $percentage = mt_rand(1500, 2500) / 10000; // 0.15 to 0.25
    //     // }
    
    //     // return round($balance * $percentage, 2);
        
    //     // Define multiplier sets based on balance
    //     if ($balance <= 50) {
    //         \Log::info('under 50: ' );
    //         $multipliers = [
    //             1 => [0.18, 0.20],
    //             2 => [0.55, 0.58],
    //             3 => [0.34, 0.36],
    //             4 => [0.33, 0.35],
    //             5 => [0.44, 0.46],
    //             6 => [0.23, 0.25],
    //             8 => [0.50, 0.52],
    //             9 => [0.50, 0.52],
    //             10 => [0.63, 0.65],
    //             11 => [0.54, 0.56],
    //             12 => [0.55, 0.57],
    //             13 => [0.52, 0.54],
    //             14 => [0.47, 0.49],
    //             15 => [0.28, 0.30],
    //             16 => [0.34, 0.36],
    //             17 => [0.10, 0.12],
    //             19 => [0.46, 0.48],
    //             20 => [0.54, 0.56],
    //             21 => [0.38, 0.40],
    //             22 => [0.45, 0.47],
    //             23 => [0.44, 0.46],
    //             25 => [0.44, 0.46]
    //         ];
    //     } else if ($balance <= 500) {
    //         \Log::info('under 500: ' );
    //         $multipliers = [
    //             1 => [0.15, 0.16],
    //             2 => [0.48, 0.52],
    //             3 => [0.44, 0.50],
    //             4 => [0.42, 0.48],
    //             5 => [0.48, 0.52],
    //             6 => [0.44, 0.50],
    //             8 => [0.42, 0.48],
    //             9 => [1.48, 1.52],
    //             10 => [1.44, 1.50],
    //             11 => [1.42, 1.48],
    //             12 => [1.48, 1.52],
    //             13 => [1.44, 1.50],
    //             14 => [1.42, 1.48],
    //             15 => [1.48, 1.52],
    //             16 => [1.44, 1.50],
    //             17 => [1.44, 1.50],
    //             19 => [1.42, 1.48],
    //             20 => [1.48, 1.52],
    //             21 => [1.44, 1.50],
    //             22 => [1.42, 1.48],
    //             23 => [1.48, 1.52],
    //             25 => [1.44, 1.50]
    //         ];
    //     } else {
    //         \Log::info('under default: ' );
    //         // Default multipliers for other balance values
    //         $multipliers = [
    //             1 => [0.18, 0.20],
    //             2 => [0.55, 0.58],
    //             3 => [0.34, 0.36],
    //             4 => [0.33, 0.35],
    //             5 => [0.44, 0.46],
    //             6 => [0.23, 0.25],
    //             8 => [0.50, 0.52],
    //             9 => [0.50, 0.52],
    //             10 => [0.63, 0.65],
    //             11 => [0.54, 0.56],
    //             12 => [0.55, 0.57],
    //             13 => [0.52, 0.54],
    //             14 => [0.47, 0.49],
    //             15 => [0.28, 0.30],
    //             16 => [0.34, 0.36],
    //             17 => [0.10, 0.12],
    //             19 => [0.46, 0.48],
    //             20 => [0.54, 0.56],
    //             21 => [0.38, 0.40],
    //             22 => [0.45, 0.47],
    //             23 => [0.44, 0.46],
    //             25 => [0.44, 0.46]
    //         ];
    //     }
    
    //     if (!isset($multipliers[$taskNumber])) {
    //         return 0;
    //     }
    
    //     [$min, $max] = $multipliers[$taskNumber];
    //     $multiplier = mt_rand($min * 10000, $max * 10000) / 10000;
    
    //     return round($balance * $multiplier, 2);
    // }
    

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
                    'message' => 'Order created successfully',
                    'order_id' => $orderId
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
