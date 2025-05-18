<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function generateProductsWithTargetAmount($targetAmount)
    {
        $productCount = 5;

        $products = DB::table('products')
            ->inRandomOrder()
            ->limit($productCount)
            ->get(['id as product_id', 'title', 'image', 'price']);

        if ($products->count() < $productCount) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough products in database.'
            ], 400);
        }

        // Step 1: Split total amount randomly
        $portions = [];
        $remaining = $targetAmount;
        for ($i = 0; $i < $productCount - 1; $i++) {
            $max = $remaining - ($productCount - $i - 1) * 1; // minimum 1 for each remaining
            $portion = round(mt_rand(100, $max * 100) / 100, 2);
            $portions[] = $portion;
            $remaining -= $portion;
        }
        $portions[] = round($remaining, 2);
        shuffle($portions);

        // Step 2: Assign quantity based on fixed price
        $comboProducts = [];
        foreach ($products as $index => $product) {
            $amount = $portions[$index];
            // Calculate quantity based on fixed price
            $quantity = ceil($amount / $product->price);
            $adjustedAmount = round($product->price * $quantity, 2);

            $comboProducts[] = [
                'product_id' => $product->product_id,
                'title'      => $product->title,
                'price'      => $product->price,
                'quantity'   => $quantity,
                'image'      => $product->image,
                'amount'     => $adjustedAmount
            ];
        }

        // Final adjustment to match total exactly
        $total = array_sum(array_column($comboProducts, 'amount'));
        $diff = round($targetAmount - $total, 2);

        if (abs($diff) > 0.01) {
            $lastIndex = count($comboProducts) - 1;
            // Adjust quantity of last product to match target amount
            $lastProduct = $comboProducts[$lastIndex];
            $newQuantity = ceil(($lastProduct['amount'] + $diff) / $lastProduct['price']);
            $comboProducts[$lastIndex]['quantity'] = $newQuantity;
            $comboProducts[$lastIndex]['amount'] = round($lastProduct['price'] * $newQuantity, 2);
        }

        // Calculate commission (5% of total amount)
        $actualAmount = array_sum(array_column($comboProducts, 'amount'));
        $commissionAmount = round($actualAmount * 0.05, 2);

        return response()->json([
            'success' => true,
            'combo' => true,
            'products' => $comboProducts,
            'total_amount' => $actualAmount,
            'commission' => $commissionAmount
        ]);
    }

    public function generatenormalProductsWithTargetAmount($targetAmount)
    {
        $productCount = 5;

        $products = DB::table('products')
            ->inRandomOrder()
            ->limit($productCount)
            ->get(['id as product_id', 'title', 'image']);

        if ($products->count() < $productCount) {
            return response()->json([
                'success' => false, 
                'message' => 'Not enough products in database.'
            ], 400);
        }

       
    }
        

}
