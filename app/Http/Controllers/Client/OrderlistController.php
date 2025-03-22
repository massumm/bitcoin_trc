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
                // Fetch 5 random products from the database
        $products = DB::table('products')->inRandomOrder()->limit(1)->get();
        // $commissionPercentage = DB::table('packages')
        //         ->where('pack_vip', 1);
        $commissionPercentage = 0;
if($projectId == 1){
    $commissionPercentage = 4;
}else if($projectId == 2){
    $commissionPercentage = 8;
}else if($projectId == 3){
    $commissionPercentage = 12;
}
                   
                // // Calculate total amount (sum of price * quantity)
        $totalAmount = $products->sum(function ($product) {
                    return $product->price * $product->quantity;
                });
                 $commission = ($totalAmount * $commissionPercentage) / 100;
    
        if ($orderAllowed) {
            // Fetch 5 random products from the database
   
            return response()->json([
                'products' => $products,
                'total_amount' => $totalAmount,
                'commission' => $commission
            ]);
        }
    
        return response()->json(['message' => 'Ordering is not allowed'], 403);
    }
    
    public function submitOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            // Create main order
            $orderId = DB::table('orders')->insertGetId([
                'order_number' => $request->order_number,
                'user_id' => Auth::id(),
                'total_amount' => $request->total_amount,
                'commission' => $request->commission,
                'expected_income' => $request->expected_income,
                'status' => 'pending',
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
            DB::table('users')
            ->where('id', auth()->id())
            ->update([
                'today_task' => DB::raw('today_task + 1'),
                'min_earn' => DB::raw('min_earn + ' . $request->commission),
                'balance' => DB::raw('balance + ' . $request->commission)
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order submitted successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit aasdf'
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

    public function updateUserStatus(Request $request)
    {
        try {
            $user = Auth::user();
            $user->status = 2;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user status'
            ], 500);
        }
    }
}
