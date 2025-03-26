@extends('layouts.minimal')

@section('title', 'deposit information')

@section('content')
<style>
    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
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
                After successful payment, you need to click the paid button,<br>
                and <a href="#" class="text-warning text-decoration-none">Contact Customer Service</a> Confirm
            </p>
        </div>

        <!-- QR Code Section -->
        <div class="card">
            <p class="text-center mb-4" style="color: #666; font-size: 14px;">
                Please use any wallet APP to scan or copy the payment address to pay(TRC20)
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
                <button class="btn btn-outline-secondary btn-sm" onclick="copyAddress()">Copy</button>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bottom-buttons">
        <div class="d-flex justify-content-between gap-3">
            <button class="btn btn-outline-secondary flex-grow-1" onclick="cancelDeposit()">
                Cancel deposit<br>application
            </button>
            <button class="btn btn-primary flex-grow-1" onclick="markTransferred()">
                Transferred
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const amount = urlParams.get('amount') || '100.00';

    document.getElementById('displayAmount').innerHTML = `${amount}<span style="font-size: 16px; margin-left: 4px;">USDT</span>`;

    let orderNumber = localStorage.getItem('orderNumber');
    if (!orderNumber) {
        orderNumber = generateOrderNumber();
        localStorage.setItem('orderNumber', orderNumber);
    }
    document.getElementById('orderNumber').textContent = orderNumber;

    fetchDepositAddress();
    startTimer();
});

function fetchDepositAddress() {
    fetch('/client/get-deposit-address')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('qrCode').src = data.qrCode;
                document.getElementById('qrCode').style.display = 'block';
                document.getElementById('loadingQR').style.display = 'none';
                document.getElementById('walletAddress').textContent = data.address;
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loadingQR').innerHTML = 
                '<p class="text-danger">Failed to load deposit address. Please try again.</p>';
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
        alert('Address copied to clipboard!');
    });
}

function cancelDeposit() {
    if (confirm('Are you sure you want to cancel this deposit?')) {
        localStorage.removeItem('orderNumber');
        history.back();
    }
}

function markTransferred() {
    alert('Please wait for confirmation from customer service.');
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
