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
        $projectId = $request->query('projectId');
        // Check if ordering is allowed
        $orderAllowed = true; // Replace with your condition
        $taskNumber = Auth::user()->today_task+1 ;
        if (Auth::user()->demostatus != 1) {
        // Get the combo for the current task number and user
        $combo = DB::table('combos')
            ->where('task_number', $taskNumber)
            ->where('user_id', Auth::id()) // Ensure it's assigned to the correct user
            ->first();
        
        if ($combo) {
            // If combo exists, decode the products JSON into an array
            $products = json_decode($combo->products, true);
            $commissionPercentage = 0;
            if ($projectId == 1) {
                $commissionPercentage = 12;
            } elseif ($projectId == 2) {
                $commissionPercentage = 16;
            } elseif ($projectId == 3) {
                $commissionPercentage = 20;
            }
        } else {
            // If no combo exists, fetch 5 random products from the database
            $products = DB::table('products')->inRandomOrder()->limit(1)->get();
            $commissionPercentage = 0;
            if ($projectId == 1) {
                $commissionPercentage = 4;
            } elseif ($projectId == 2) {
                $commissionPercentage = 8;
            } elseif ($projectId == 3) {
                $commissionPercentage = 12;
            }
        }
    
        // Set commission percentage based on the project ID
     
    
        // Calculate the total amount (sum of price * quantity)
        if($combo){
            $totalAmount = collect($products)->sum(function ($product) {
                return $product['price'] * $product['quantity'];
            });
        }else{
            $totalAmount = $products->sum(function ($product) {
                return $product->price * $product->quantity;
            });
        }
        }else{
            $combo = DB::table('demo_combos')
            ->where('task_number', $taskNumber)
            ->first();
            if ($combo) {
            $products = json_decode($combo->products, true);
            $commissionPercentage = $combo->commission;
            $totalAmount = collect($products)->sum(function ($product) {
                return $product['price'] * $product['quantity'];
            });

        }else{
            $products = DB::table('products')->inRandomOrder()->limit(1)->get();
            $commissionPercentage = 0;
            if ($projectId == 1) {
                $commissionPercentage = 4;
            } elseif ($projectId == 2) {
                $commissionPercentage = 8;
            } elseif ($projectId == 3) {
                $commissionPercentage = 12;
            }
            $totalAmount = $products->sum(function ($product) {
                return $product->price * $product->quantity;
            });
        }


        }
        // Calculate the commission
        $commission = ($totalAmount * $commissionPercentage) / 100;
    
        // Return the response
        if ($orderAllowed) {
            return response()->json([
                'products' => $products,
                'total_amount' => number_format($totalAmount, 2, '.', ''),
                'commission' => number_format($commission, 2, '.', '')
            ]);
        }
    
        // If ordering is not allowed, return a message
        return response()->json(['message' => 'Ordering is not allowed'], 403);
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
                // Update user status to 2 (Restricted)
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['status' => "2"]);
        
                DB::commit();
        
                $needBalance = number_format($request->total_amount - $user->balance, 2);
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient balance, you need to top up $needBalance USDT",
                    'need_balance' => $needBalance
                ], 403);
            }
        
            // If balance is sufficient, update user stats
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'status' => "1",
                    'today_task' => DB::raw('CASE WHEN today_task + 1 >= 25 THEN 0 ELSE today_task + 1 END'),
                    'min_earn' => DB::raw('min_earn + ' . $request->commission),
                    'balance' => DB::raw('balance + ' . $request->commission)
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
