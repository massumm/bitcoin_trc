@extends('layouts.minimal')

@section('title', 'deposit information')

@section('content')
<div class="container px-3">
    <!-- Amount Display -->
    <div class="text-center mb-4">
        <h1 class="display-4 mb-2" style="font-size: 48px; font-weight: bold;" id="displayAmount">100.00<span style="font-size: 16px; margin-left: 4px;">USDT</span></h1>
    </div>

    <!-- Order Information -->
    <div class="mb-4 text-center">
        <p class="text-muted" style="font-size: 14px;">
            Order Nos: <span id="orderNumber" style="color: #333;">108614277014750032</span>
            <span class="text-danger ms-2" style="font-size: 14px;">(<span id="timer">4319:57</span>)</span>
        </p>
    </div>

    <!-- Instructions -->
    <div class="mb-4 text-center">
        <p style="color: #666; font-size: 14px; line-height: 1.5;">
            After successful payment, you need to click the paid button,<br>
            and <a href="#" class="text-warning text-decoration-none">Contact Customer Service</a> Confirm
        </p>
    </div>

    <!-- QR Code Section -->
    <div class="card p-4 mb-4">
        <p class="text-center mb-4" style="color: #666; font-size: 14px;">Please use any wallet APP to scan or copy the payment address to pay(TRC20)</p>
        
        <div class="text-center mb-4">
            <img src="data:image/png;base64,YOUR_QR_CODE_BASE64" alt="QR Code" class="img-fluid" style="max-width: 200px;">
        </div>

        <!-- Wallet Address -->
        <div class="text-center mb-3">
            <p class="text-break mb-2" id="walletAddress" style="color: #333; word-wrap: break-word;">TXS2ToRE1godmqT9i98p2S52qjFUXGsFVb</p>
            <button class="btn btn-outline-secondary btn-sm" onclick="copyAddress()">Copy</button>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between gap-3 fixed-bottom p-3">
        <button class="btn btn-outline-secondary flex-grow-1" style="height: 40px;" onclick="cancelDeposit()">
            Cancel deposit<br>application
        </button>
        <button class="btn btn-primary flex-grow-1" style="height: 40px;" onclick="markTransferred()">
            Transferred
        </button>
    </div>
</div>

<style>
.display-4 {
    margin: 0;
    padding: 0;
    text-align: center;
}
.container {
    max-width: 600px;
    margin: 0 auto;
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const amount = urlParams.get('amount') || '100.00';

    document.getElementById('displayAmount').innerHTML = `${amount}<span class="fs-5">USDT</span>`;

    // Check if an order number already exists in local storage
    let orderNumber = localStorage.getItem('orderNumber');

    if (!orderNumber) {
        orderNumber = generateOrderNumber();
        localStorage.setItem('orderNumber', orderNumber); // Store it so it persists after reload
    }

    document.getElementById('orderNumber').textContent = orderNumber;

    // Send the order data to the backend
    fetch('/client/mine/depositpost', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ amount: amount, orderNumber: orderNumber })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data);
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });

    startTimer();
});

function generateOrderNumber() {
    const timestamp = Date.now().toString().slice(-10); // Last 10 digits of timestamp
    const randomPart = Math.floor(100000 + Math.random() * 900000); // 6-digit random number
    return timestamp + randomPart;
}

// Clear order number only when deposit is canceled
function cancelDeposit() {
    if (confirm('Are you sure you want to cancel this deposit?')) {
        localStorage.removeItem('orderNumber'); // Remove stored order number
        history.back();
    }
}

// Clear order number when user marks payment as transferred
function markTransferred() {
    alert('Please wait for confirmation from customer service.');
    localStorage.removeItem('orderNumber'); // Clear order number
}

</script>
@endsection
