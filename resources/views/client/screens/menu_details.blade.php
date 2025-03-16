@extends('layouts.minimal')

@section('title', $name ?? 'Project Details')

@section('content')
<style>
    /* Full page background */
    body {
        background-color: #F8F8F8;
    }

    /* Blue gradient header */
    .top-section {
        background: linear-gradient(to right, #4A90E2, #2563eb);
        height: 300px;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
    }

    /* Page container */
    .container {
        position: relative;
        top: 60px;
        text-align: center;
    }

    /* Account balance text */
    .balance {
        color: white;
        font-size: 18px;
        font-weight: 500;
        margin-top: 20px;
    }

    .balance h2 {
        font-size: 28px;
        font-weight: bold;
    }

    /* Centered info card */
    .info-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 400px;
        margin: auto;
        text-align: center;
        position: relative;
        top: 40px;
    }

    .info-card .row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
    }

    /* Order Button */
    .btn-primary {
        display: block;
        width: 80%;
        background: #3B82F6;
        font-size: 18px;
        padding: 12px;
        border-radius: 25px;
        font-weight: bold;
        margin: 40px auto 20px auto;
    }

    /* Hint box */
    .hint-box {
        width: 90%;
        max-width: 400px;
        margin: auto;
        text-align: left;
        font-size: 14px;
        color: #666;
    }

    /* Popup Background */
    .popup-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2);
        display: none;
        justify-content: center;
        align-items: center;
    }

    /* Popup Card */
    .popup-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    /* Close Button */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 18px;
        cursor: pointer;
        color: #555;
    }

    /* Gray Order Details Card */
    .order-details {
        background: #E0E0E0;
        border-radius: 8px;
        padding: 15px;
        margin-top: 10px;
    }

    /* Submit Order Button */
    .btn-submit {
        background: #3B82F6;
        color: white;
        font-size: 16px;
        padding: 10px;
        border-radius: 25px;
        width: 100%;
        margin-top: 20px;
    }

</style>

<!-- Blue background -->
<div class="top-section"></div>

<!-- Page Content -->
<div class="container">
    <!-- Page Title -->
    <h2 class="text-white">{{ $name }}</h2>

    <!-- Account Balance -->
    <div class="balance">
        <p>Account Balance:</p>
        <h2>620.81 USDT</h2>
    </div>

    <!-- Centered Card -->
    <div class="info-card">
        <div class="row">
            <div class="col-6">
                <p>Today's Times</p>
                <h5>1</h5>
            </div>
            <div class="col-6">
                <p>Today's Commission</p>
                <h5>20.81 USDT</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p>Cash gap between tasks</p>
                <h5>0 USDT</h5>
            </div>
            <div class="col-6">
                <p>Yesterday's Buy Commission</p>
                <h5>0 USDT</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p>Yesterday's Team Commission</p>
                <h5>0 USDT</h5>
            </div>
            <div class="col-6">
                <p>Money Frozen in Accounts</p>
                <h5>0 USDT</h5>
            </div>
        </div>
    </div>

    <!-- Grab Order Button -->
    <button class="btn btn-primary" onclick="openPopup()">Grab the order immediately</button>

    <!-- Hint Section -->
    <div class="hint-box">
        <h6>Hint:</h6>
        <p>1: 5% of the amount of completed transactions earned.</p>
        <p>2: The system sends tasks randomly. Complete them as soon as possible after matching them, to avoid hanging all the time.</p>
    </div>
</div>

<!-- Order Popup -->
<div class="popup-bg" id="orderPopup">
    <div class="popup-card">
        <span class="close-btn" onclick="closePopup()">✖</span>
        <h4>Order Details</h4>

        <div class="order-details">
            <p><strong>Order No:</strong> 12345678</p>
            <div class="mt-3">
                <p><strong>Transaction Time:</strong> 2025-03-16 12:30 PM</p>
                <p><strong>Order Commission:</strong> 5.25 USDT</p>
            </div>
        </div>

        <button class="btn-submit">Submit Order</button>
    </div>
</div>

<script>
    function openPopup() {
        document.getElementById("orderPopup").style.display = "flex";
    }

    function closePopup() {
        toastr.success('Grab button clicked!', 'Success');C
        document.getElementById("orderPopup").style.display = "none";
    }
</script>

@endsection
