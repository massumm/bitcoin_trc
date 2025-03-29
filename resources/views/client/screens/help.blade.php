@extends('layouts.minimal')

@section('title', __('messages.help'))

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
        {{ __('messages.deposit_information') }}
    </div>
    <div class="help-content">
        <p>• {{ __('messages.minimum_deposit_amount') }}: <span class="important">10 USDT</span></p>
        <p>• {{ __('messages.please_check_the_latest_deposit_method_before_proceeding') }}</p>
        <p>• {{ __('messages.deposits_are_typically_credited_within') }} <span class="important">10-30 minutes</span></p>
        <p>• {{ __('messages.only_use_the_provided_deposit_address') }}</p>
    </div>
</div>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-money-bill-transfer"></i>
        {{ __('messages.withdrawal_rules') }}
    </div>
    <div class="help-content">
        <p>• {{ __('messages.minimum_withdrawal') }}: <span class="important">20 USDT</span></p>
        <p>• {{ __('messages.processing_time') }}: <span class="important">within 24 hours</span></p>
        <p>• {{ __('messages.daily_withdrawal_limit') }}: <span class="important">5000 USDT</span></p>
        <p>• {{ __('messages.ensure_your_withdrawal_address_is_correct') }}</p>
    </div>
</div>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-shield-alt"></i>
        {{ __('messages.account_security') }}
    </div>
    <div class="help-content">
        <p>• {{ __('messages.one_account_per_mobile_number_only') }}</p>
        <p>• {{ __('messages.multiple_accounts_will_result_in_account_freeze') }}</p>
        <p>• {{ __('messages.keep_your_login_credentials_secure') }}</p>
        <p>• {{ __('messages.enable_2fa_for_additional_security') }}</p>
    </div>
</div>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-clock"></i>
        {{ __('messages.order_information') }}
    </div>
    <div class="help-content">
        <p>• {{ __('messages.orders_not_delivered_within_10_minutes_will_be_frozen') }}</p>
        <p>• {{ __('messages.check_order_status_in_the_records_section') }}</p>
        <p>• {{ __('messages.contact_support_for_frozen_orders') }}</p>
        <p>• {{ __('messages.keep_transaction_records_for_reference') }}</p>
    </div>
</div>

<div class="help-section">
    <div class="help-title">
        <i class="fas fa-headset"></i>
            {{ __('messages.customer_support') }}
    </div>
    <div class="help-content">
        <p>• 24/7 customer service available</p>
        <p>• Use the online chat for quick responses</p>
        <p>• Email support: support@example.com</p>
        <p>• Response time: within 12 hours</p>
    </div>
</div>
@endsection
