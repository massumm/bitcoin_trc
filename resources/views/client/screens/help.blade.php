@extends('layouts.minimal')

@section('title', __('messages.help'))

@section('content')
<style>

    .back-button {
        font-size: 20px;
        color: #333;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin-bottom: 20px;
    }
    .page-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }
    .intro-text {
        font-size: 16px;
        color: #333;
        margin-bottom: 20px;
    }
    .help-section {
        margin-bottom: 25px;
    }
    .help-title {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }
    .help-content {
        font-size: 14px;
        color: #333;
        line-height: 1.6;
    }
</style>

<div class="help-container">
    <p class="intro-text"> {{ __('messages.frequently_asked_questions') }} </p>

    <div class="help-section">
        <div class="help-title">1. {{ __('messages.about_recharge') }}</div>
        <div class="help-content">
            {{ __('messages.about_recharge_content') }}
        </div>
    </div>

    <div class="help-section">
        <div class="help-title">2. {{ __('messages.about_withdrawal') }}</div>
        <div class="help-content">
            {{ __('messages.about_withdrawal_content') }}
        </div>
    </div>

    <div class="help-section">
        <div class="help-title">3. {{ __('messages.about_grabbing_orders_and_freezing_orders') }}</div>
        <div class="help-content">
            {{ __('messages.about_grabbing_orders_and_freezing_orders_content') }}
        </div>
    </div>
</div>
@endsection
