@extends('layouts.minimal')

@section('title', __('messages.deposit_information'))

@section('content')
<style>
    .container {
        max-width: 400px;
        margin: 0 auto;
    }
    .display-4 {
        margin: 0;
        padding: 0;
        text-align: center;
        font-size: 48px;
        font-weight: bold;
    }
    .card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        text-align: center;
    }
    .btn-outline-secondary {
        border-color: #ddd;
        color: #666;
    }
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        border-color: #ddd;
        color: #333;
    }
    .btn-primary {
        background-color: #4169E1;
        border-color: #4169E1;
    }
    #qrCode {
        max-width: 180px;
        margin: 0 auto;
    }
    .wallet-address {
        word-break: break-all;
        margin: 15px 0;
        color: #333;
        font-size: 14px;
    }
    .bottom-buttons {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 15px;
        background: white;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    }
    .main-content {
        padding-bottom: 100px; /* Space for fixed bottom buttons */
    }
</style>

<div class="container">
    <div class="main-content">
        <!-- Amount Display -->
        <div class="text-center mb-4">
            <h1 class="display-4" id="displayAmount">100.00<span style="font-size: 16px; margin-left: 4px;">USDT</span></h1>
        </div>

        <!-- Order Information -->
        <div class="text-center mb-4">
            <p class="text-muted" style="font-size: 14px;">
                Order Nos: <span id="orderNumber" style="color: #333;">108614277014750032</span>
                <span class="text-danger ms-2" style="font-size: 14px;">(<span id="timer">4319:57</span>)</span>
            </p>
        </div>

        <!-- Instructions -->
        <div class="text-center mb-4">
            <p style="color: #666; font-size: 14px; line-height: 1.5;">
                {{ __('messages.after_successful_payment') }}, {{ __('messages.you_need_to_click_the_paid_button') }},<br>
                {{ __('messages.and') }} <a href="#" class="text-warning text-decoration-none">{{ __('messages.contact_customer_service') }}</a> {{ __('messages.confirm') }}
            </p>
        </div>

        <!-- QR Code Section -->
        <div class="card">
            <p class="text-center mb-4" style="color: #666; font-size: 14px;">
                {{ __('messages.please_use_any_wallet_app_to_scan_or_copy_the_payment_address_to_pay') }} ({{ __('messages.trc20') }})
            </p>
            
            <div class="text-center">
                <img id="qrCode" src="" alt="QR Code" class="img-fluid">
                <div id="loadingQR" class="my-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <!-- Wallet Address -->
            <div class="text-center">
                <p class="wallet-address" id="walletAddress"></p>
                <button class="btn btn-outline-secondary btn-sm" onclick="copyAddress()">{{ __('messages.copy') }}</button>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bottom-buttons">
        <div class="d-flex justify-content-between gap-3">
            <button class="btn btn-outline-secondary flex-grow-1" onclick="cancelDeposit()">
                    {{ __('messages.cancel_deposit_application') }}
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="markTransferred()">
                {{ __('messages.transferred') }}
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const amount = urlParams.get('amount') || '100.00';

    document.getElementById('displayAmount').innerHTML = `${amount}<span style="font-size: 16px; margin-left: 4px;">{{ __('messages.usdt') }}</span>`;

    let orderNumber = localStorage.getItem('orderNumber');
    if (!orderNumber) {
        orderNumber = generateOrderNumber();
        localStorage.setItem('orderNumber', orderNumber);
    }
    document.getElementById('orderNumber').textContent = orderNumber;
  
    fetchDepositAddress(orderNumber);
    startTimer();
});

function fetchDepositAddress(orderNumber) {
    const urlParams = new URLSearchParams(window.location.search);
    const amount = urlParams.get('amount') || '100.00';
   

    fetch('/client/get-deposit-address', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            amount: amount,
            orderNumber: orderNumber
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.hasPendingDeposit) {
                // Handle existing pending deposit
                document.getElementById('qrCode').src = data.qrCode;
                document.getElementById('qrCode').style.display = 'block';
                document.getElementById('loadingQR').style.display = 'none';
                document.getElementById('walletAddress').textContent = data.pendingDeposit.address;
            } else {
                // Handle new deposit
                document.getElementById('qrCode').src = data.qrCode;
                document.getElementById('qrCode').style.display = 'block';
                document.getElementById('loadingQR').style.display = 'none';
                document.getElementById('walletAddress').textContent = data.address;
            }
        } else {
            throw new Error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loadingQR').innerHTML = 
            '<p class="text-danger">{{ __('messages.failed_to_load_deposit_address_please_try_again') }}</p>';
    });
}

function generateOrderNumber() {
    const timestamp = Date.now().toString().slice(-10);
    const randomPart = Math.floor(100000 + Math.random() * 900000);
    return timestamp + randomPart;
}

function copyAddress() {
    const address = document.getElementById('walletAddress').textContent;
    navigator.clipboard.writeText(address).then(() => {
        alert('{{ __('messages.address_copied_to_clipboard') }}');
    });
}

function cancelDeposit() {
    if (confirm('{{ __('messages.are_you_sure_you_want_to_cancel_this_deposit') }}')) {
        localStorage.removeItem('orderNumber');
        history.back();
    }
}

function markTransferred() {
    alert('{{ __('messages.please_wait_for_confirmation_from_customer_service') }}');
    localStorage.removeItem('orderNumber');
}

function startTimer() {
    let minutes = 4319;
    let seconds = 57;
    
    setInterval(() => {
        if (seconds === 0) {
            minutes--;
            seconds = 59;
        } else {
            seconds--;
        }
        document.getElementById('timer').textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }, 1000);
}
</script>
@endsection
