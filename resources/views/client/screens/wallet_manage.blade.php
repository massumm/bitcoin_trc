@extends('layouts.minimal2')

@section('title', __('messages.wallet_management'))

@section('content')

<style>
    .wallet-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        
    }
    
    .wallet-card {
        width: 100%;
        max-width: 400px;
        background: linear-gradient(to right, #6a9afe, #4a77ff);
        color: white;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        position: relative;
    }
    
    .wallet-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .wallet-icon {
        display: flex;
        align-items: center;
    }
    
    .wallet-icon img {
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }
    
    .wallet-name {
        font-size: 18px;
        font-weight: bold;
    }
    
    .wallet-protocol {
        font-size: 14px;
        opacity: 0.9;
    }
    
    .wallet-address {
        font-size: 14px;
        margin-top: 10px;
        word-break: break-word;
    }

    .more-options {
        font-size: 20px;
        cursor: pointer;
    }

    .btn-container {
        margin-bottom: 15px;
        display: flex;
        justify-content: center;
    }
    
    .btn-virtual-currency {
        background: #4A90E2;
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
    }
</style>

<div class="wallet-container">
    <div class="btn-container">
        <button class="btn-virtual-currency">virtual currency</button>
    </div>

    @foreach ($wallets as $wallet)
        <div class="wallet-card">
            <div class="wallet-header">
                <div class="wallet-icon">
                <img src="{{ asset('assets/img/wallet-icon.png') }}" alt="Binance">
                    <div>
                        <div class="wallet-name">{{ $wallet->names }}</div>
                        <div class="wallet-protocol">{{ $wallet->currency_protocol }}</div>
                    </div>
                </div>
                <div class="more-options">⋮</div>
            </div>
            <div class="wallet-address">{{ $wallet->wallet_address }}</div>
        </div>
    @endforeach
</div>

@endsection
