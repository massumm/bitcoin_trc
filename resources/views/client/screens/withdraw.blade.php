@extends('layouts.minimal')

@section('title', 'Withdraw')

@section('content')

<style>
    .withdraw-container {
        background: white;
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        margin: 20px;
    }
    .wallet-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }
    .wallet-icon {
        display: flex;
        align-items: center;
    }
    .wallet-icon img {
        width: 24px;
        height: 24px;
        margin-right: 8px;
    }
    .wallet-name {
        font-size: 16px;
        color: black;
    }
    .wallet-check {
        color: red;
        font-size: 18px;
    }
    .input-group {
        margin-top: 15px;
    }
    .input-label {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }
    .input-field {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
    }
    .max-amount {
        font-size: 12px;
        color: #888;
        text-align: right;
        margin-top: 3px;
    }
    .withdraw-btn {
        width: 100%;
        padding: 12px;
        background: #a0bff8;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        margin-top: 20px;
        cursor: pointer;
    }
    .withdraw-btn:disabled {
        background: #d0d7f5;
        cursor: not-allowed;
    }
    .add-wallet-container {
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: white;
    }
    .add-wallet-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #4A90E2;
        color: white;
        border: none;
        font-size: 24px;
        margin-bottom: 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    .add-wallet-text {
        color: #666;
        font-size: 16px;
        text-decoration: none;
    }
    .add-wallet-link {
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>

<!-- Initial Add Wallet Screen -->
<div class="add-wallet-container" id="addWalletScreen">
    <a href="/client/mine/virtualcurrency" class="add-wallet-link">
        <div class="add-wallet-btn">+</div>
        <span class="add-wallet-text">Add e-wallet</span>
    </a>
</div>

<!-- Wallet Details Form (Initially Hidden) -->
<div class="withdraw-container" id="walletDetailsForm" style="display: none;">
    <!-- Wallet Selection -->
    <div class="wallet-section">
        <div class="wallet-icon">
            <img src="{{ asset('assets/img/wallet-icon.png') }}" alt="Wallet">
            <span class="wallet-name">Binance (TRC-20)</span>
        </div>
        <span class="wallet-check">✔</span>
    </div>

    <!-- Amount Input -->
    <div class="input-group">
        <label class="input-label">USDT</label>
        <input type="number" class="input-field" id="amountInput" placeholder="Enter amount">
        <div class="max-amount">Maximum amount</div>
    </div>

    <!-- Withdrawal Password -->
    <div class="input-group">
        <label class="input-label">Withdrawal password</label>
        <input type="password" class="input-field" placeholder="Please enter your password">
    </div>

    <!-- Withdraw Button -->
    <button class="withdraw-btn" id="withdrawButton" disabled>OK</button>
</div>

<script>
    // Amount input validation
    document.getElementById('amountInput').addEventListener('input', function() {
        let button = document.getElementById('withdrawButton');
        button.disabled = this.value.trim() === '';
    });
</script>

@endsection
