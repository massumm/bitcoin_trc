@extends('layouts.minimal2')

@section('title', __('messages.withdraw'))

@section('content')

<style>
    .withdraw-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
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
        position: relative;
    }
    .input-label {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }
    .input-field {
        width: 100%;
        padding: 10px;
        padding-right: 80px; /* space for maximum button */
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
    .max-button {
        position: absolute;
        right: 10px;
        top: 35px;
        background: none;
        border: none;
        color: #4A90E2;
        font-weight: bold;
        cursor: pointer;
        font-size: 14px;
    }
    .withdraw-btn {
        width: 100%;
        padding: 12px;
        background: #d0d7f5; /* light color when disabled */
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        margin-top: 20px;
        cursor: not-allowed;
        transition: background 0.3s;
    }
    .withdraw-btn.active {
        background: #4A90E2; /* bright blue when active */
        cursor: pointer;
    }
</style>

@if(Auth::user()->withdraw_status != 1)
    <div class="add-wallet-container" id="addWalletScreen">
        <a href="/client/mine/virtualcurrency" class="add-wallet-link">
            <div class="add-wallet-btn">+</div>
            <span class="add-wallet-text">{{ __('messages.add_e_wallet') }}</span>
        </a>
    </div>
@else

<div class="withdraw-container" id="walletDetailsForm">
    <!-- Wallet Selection -->
    <div class="wallet-section">
        <div class="wallet-icon">
            <img src="{{ asset('assets/img/wallet-icon.png') }}" alt="Wallet">
            <span class="wallet-name">{{ __('messages.binance') }} ({{ __('messages.trc20') }})</span>
        </div>
        <span class="wallet-check">✔</span>
    </div>

    <!-- Amount Input -->
    <div class="input-group">
        <label class="input-label">{{ __('messages.usdt') }}</label>
        <input type="number" class="input-field" id="amountInput" placeholder="{{ __('messages.enter_amount') }}">
        <button type="button" class="max-button" id="maxAmountButton">{{ __('messages.maximum_amount') }}</button>
        <div class="max-amount">{{ __('messages.maximum_amount') }}</div>
    </div>

    <!-- Withdrawal Password -->
    <div class="input-group">
        <label class="input-label">{{ __('messages.withdrawal_password') }}</label>
        <input type="password" class="input-field" id="withdrawalPassword" placeholder="{{ __('messages.please_enter_your_password') }}">
    </div>

    <!-- Withdraw Button -->
    <button class="withdraw-btn" id="withdrawButton" disabled>{{ __('messages.ok') }}</button>
</div>
@endif

<script>
    function showSuccessMessage(message) {
    const toast = document.createElement('div');
    toast.className = 'alert alert-success position-fixed start-50 top-50 translate-middle';
    toast.style.zIndex = '1050';
    toast.style.minWidth = '300px';
    toast.style.maxWidth = '80%';
    toast.style.width = 'auto';
    toast.style.textAlign = 'center';
  
    toast.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + message;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

    const amountInput = document.getElementById('amountInput');
    const withdrawButton = document.getElementById('withdrawButton');
    const maxAmountButton = document.getElementById('maxAmountButton');

    amountInput.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            withdrawButton.disabled = false;
            withdrawButton.classList.add('active');
        } else {
            withdrawButton.disabled = true;
            withdrawButton.classList.remove('active');
        }
    });

    maxAmountButton.addEventListener('click', function() {
        const maxBalance = Math.floor({{ Auth::user()->balance }}); // no decimals
        amountInput.value = maxBalance;

        if (maxBalance !== 0) {
            withdrawButton.disabled = false;
            withdrawButton.classList.add('active');
        } else {
            withdrawButton.disabled = true;
            withdrawButton.classList.remove('active');
        }
    });

    withdrawButton.addEventListener('click', function() {
        let amount = amountInput.value;
        let withdrawalPassword = document.getElementById('withdrawalPassword').value;

        fetch('/client/mine/withdraw', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ amount: amount, withdrawal_password: withdrawalPassword })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data);
                showSuccessMessage(data.message);
                window.location.href = '/client/mine'; // or show a success message
            } else {
                alert(data.message || 'Failed to withdraw');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
</script>

@endsection
