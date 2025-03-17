@extends('layouts.minimal')

@section('title', 'Deposit')

@section('content')
    <div class="container px-3 py-4">
        <!-- Payment Method Section -->
        <h6 class="text-dark mb-2">Payment method</h6>
        <div class="border rounded p-2 position-relative" style="width: 100px;">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('images/usdt-icon.png') }}" alt="USDT" style="width: 35px; height: 35px;">
                <span class="text-secondary">USDT</span>
            </div>
            <div class="position-absolute" style="bottom: 0; right: 0; transform: translate(25%, 25%);">
                <div style="width: 14px; height: 14px; background: red; transform: rotate(45deg);"></div>
            </div>
        </div>

        <!-- Protocol Selection -->
        <h6 class="text-dark mt-3 mb-2">Select the protocol to use</h6>
        <div class="border rounded p-2 position-relative" style="width: 100px;">
            <div class="d-flex flex-column align-items-center">
                <span class="text-secondary">TRC20#</span>
            </div>
            <div class="position-absolute" style="bottom: 0; right: 0; transform: translate(25%, 25%);">
                <div style="width: 14px; height: 14px; background: red; transform: rotate(45deg);"></div>
            </div>
        </div>

        <!-- Deposit Amount -->
        <h6 class="text-dark mt-3 mb-2">Deposit amount</h6>
        <div class="border rounded p-2 d-flex align-items-center">
            <span class="text-dark me-2">USDT</span>
            <input type="number" class="form-control border-0" placeholder="Deposit amount must be greater than 10USDT" min="10" id="depositAmount" style="flex: 1; height: 30px;">
        </div>

        <!-- Payment Information -->
        <div class="mt-3">
            <div class="d-flex align-items-center">
                <span class="text-secondary">Estimated payment:</span>
                <span class="ms-2" id="estimatedPayment" style="color: orange;">0.00</span>
                <span class="ms-1 text-secondary">USDT</span>
            </div>
            <p class="text-secondary small mt-1">Reference rate: 1USDT=1USDT</p>
            <p class="text-muted small">The payment amount and exchange rate are subject to the actual payment</p>
        </div>

        <!-- Deposit Button -->
        <button id="depositNow" class="btn w-100 text-white mt-3" style="background-color: #AEC6FF; border-radius: 8px; height: 40px;">Deposit now</button>
    </div>

    <script>
    document.getElementById('depositAmount').addEventListener('input', function() {
        const amount = this.value || '0.00';
        document.getElementById('estimatedPayment').textContent = parseFloat(amount).toFixed(2);
    });

    document.getElementById('depositNow').addEventListener('click', function() {
        const amount = document.getElementById('depositAmount').value;
        if (amount && parseFloat(amount) >= 10) {
            window.location.href = '/client/mine/virtualdetail?amount=' + amount;
        } else {
            alert('Please enter an amount greater than 10 USDT');
        }
    });
    </script>
@endsection
