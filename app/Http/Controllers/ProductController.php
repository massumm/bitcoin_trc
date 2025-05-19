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
            ->where('price', '<', 6)
            ->inRandomOrder()
            ->limit($productCount)
            ->get(['id as product_id', 'title', 'image', 'price']);
    
        if ($products->count() < $productCount) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough products in database.'
            ], 400);
        }
    
        // Step 1: Initial distribution of quantities
        $comboProducts = [];
        $totalUsed = 0;
        $remainingAmount = $targetAmount;
    
        foreach ($products as $index => $product) {
            if ($index === count($products) - 1) {
                // For last product, calculate exact quantity needed
                $quantity = max(1, round($remainingAmount / $product->price));
                $amount = round($product->price * $quantity, 2);
                
                // If we're over target, reduce quantity
                while ($amount > $remainingAmount && $quantity > 1) {
                    $quantity--;
                    $amount = round($product->price * $quantity, 2);
                }
            } else {
                // For other products, use a reasonable portion
                $maxQuantity = floor($remainingAmount / $product->price);
                $quantity = max(1, min($maxQuantity, rand(1, 3)));
                $amount = round($product->price * $quantity, 2);
            }
            
            $remainingAmount -= $amount;
    
            $comboProducts[] = [
                'product_id' => $product->product_id,
                'title'      => $product->title,
                'price'      => $product->price,
                'quantity'   => $quantity,
                'image'      => $product->image,
                'amount'     => $amount
            ];
    
            $totalUsed += $amount;
        }
    
        // Step 2: Fine-tune the last product to match target exactly
        $diff = round($targetAmount - $totalUsed, 2);
    
        if (abs($diff) >= 0.01) {
            $lastIndex = count($comboProducts) - 1;
            $last = $comboProducts[$lastIndex];
    
            $newQuantity = round(($last['amount'] + $diff) / $last['price']);
            $newQuantity = max(1, $newQuantity);
    
            $newAmount = round($last['price'] * $newQuantity, 2);
            $comboProducts[$lastIndex]['quantity'] = $newQuantity;
            $comboProducts[$lastIndex]['amount'] = $newAmount;
            
            // Update total used
            $totalUsed = $totalUsed - $last['amount'] + $newAmount;
        }
    
        // Final verification and adjustment
        $actualAmount = array_sum(array_column($comboProducts, 'amount'));
        if (abs($actualAmount - $targetAmount) >= 0.01) {
            $lastIndex = count($comboProducts) - 1;
            $last = $comboProducts[$lastIndex];
            $diff = $targetAmount - $actualAmount;
            
            $newQuantity = round(($last['amount'] + $diff) / $last['price']);
            $newQuantity = max(1, $newQuantity);
            
            $newAmount = round($last['price'] * $newQuantity, 2);
            $comboProducts[$lastIndex]['quantity'] = $newQuantity;
            $comboProducts[$lastIndex]['amount'] = $newAmount;
            
            $actualAmount = array_sum(array_column($comboProducts, 'amount'));
        }
    
        $commissionAmount = round($actualAmount * 0.05, 2);
    
        return response()->json([
            'success' => true,
            'combo' => true,
            'products' => $comboProducts,
            'total_amount' => $targetAmount,
            'commission' => $commissionAmount
        ]);
    }
    
}