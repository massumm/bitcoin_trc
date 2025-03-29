<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'wallet_name' => 'required|string|max:255',
            'currency_protocol' => 'required|string',
            'wallet_address' => 'required|string|max:255',
            'names' => 'required|string|max:255',
        ]);

        // Create new wallet record
        $wallet = new Wallet();
        $wallet->user_id = auth()->id(); // Get current user's ID
        $wallet->wallet_name = $validated['wallet_name'];
        $wallet->currency_protocol = $validated['currency_protocol'];
        $wallet->wallet_address = $validated['wallet_address'];
        $wallet->names = $validated['names'];
        $wallet->save();

        // Redirect with success message
        return redirect()->route('dashboard')
            ->with('success', __('messages.wallet_added_successfully'));
    }
} 