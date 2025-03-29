@extends('layouts.minimal')

@section('title', __('messages.platform_rules'))

@section('content')

<div class="card p-3">
    <p>
        <strong>{{ __('messages.about_recharge') }}</strong> {{ __('messages.the_platform_will_change_the_recharge_method_from_time_to_time') }}.
        {{ __('messages.each_user_should_check_the_latest_recharge_method_before_recharging_to_avoid_failures') }}.
    </p>
    
    <p>
        <strong>{{ __('messages.about_withdrawal') }}</strong> {{ __('messages.the_minimum_withdrawal_amount_of_mall') }} {{ __('messages.is') }} **20 USDT**, {{ __('messages.and_the_minimum_deposit_is') }} **10 USDT**.
        {{ __('messages.withdrawals_are_processed_within') }} **24 hours**.
    </p>
    
    <p>
        <strong>{{ __('messages.freezing_orders') }}</strong> {{ __('messages.if_an_order_is_not_delivered_within') }} **10 minutes**, {{ __('messages.the_order_will_be') }} **frozen**.
    </p>

    <p>
        <strong>{{ __('messages.account_policy') }}</strong> {{ __('messages.only_one_account_per_mobile_number_is_allowed') }}. 
        {{ __('messages.multiple_accounts_may_lead_to_an_account_freeze_due_to_suspected_money_laundering') }}.
    </p>
</div>

@endsection
