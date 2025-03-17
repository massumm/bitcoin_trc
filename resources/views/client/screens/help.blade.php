@extends('layouts.minimal')

@section('title', 'Help')

@section('content')
<style>
    .help-section {
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }
    .help-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .help-title {
        color: #333;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }
    .help-title i {
        margin-right: 8px;
        color: #4169E1;
    }
    .help-content {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
        padding-left: 25px;
    }
    .important {
        color: #4169E1;
        font-weight: 500;
    }
</style>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-wallet"></i>
        Deposit Information
    </div>
    <div class="help-content">
        <p>• Minimum deposit amount: <span class="important">10 USDT</span></p>
        <p>• Please check the latest deposit method before proceeding</p>
        <p>• Deposits are typically credited within <span class="important">10-30 minutes</span></p>
        <p>• Only use the provided deposit address</p>
    </div>
</div>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-money-bill-transfer"></i>
        Withdrawal Rules
    </div>
    <div class="help-content">
        <p>• Minimum withdrawal: <span class="important">20 USDT</span></p>
        <p>• Processing time: <span class="important">within 24 hours</span></p>
        <p>• Daily withdrawal limit: <span class="important">5000 USDT</span></p>
        <p>• Ensure your withdrawal address is correct</p>
    </div>
</div>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-shield-alt"></i>
        Account Security
    </div>
    <div class="help-content">
        <p>• One account per mobile number only</p>
        <p>• Multiple accounts will result in account freeze</p>
        <p>• Keep your login credentials secure</p>
        <p>• Enable 2FA for additional security</p>
    </div>
</div>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-clock"></i>
        Order Information
    </div>
    <div class="help-content">
        <p>• Orders not delivered within <span class="important">10 minutes</span> will be frozen</p>
        <p>• Check order status in the Records section</p>
        <p>• Contact support for frozen orders</p>
        <p>• Keep transaction records for reference</p>
    </div>
</div>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-headset"></i>
        Customer Support
    </div>
    <div class="help-content">
        <p>• 24/7 customer service available</p>
        <p>• Use the online chat for quick responses</p>
        <p>• Email support: support@example.com</p>
        <p>• Response time: within 12 hours</p>
    </div>
</div>
@endsection
