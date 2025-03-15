@extends('layouts.minimal')

@section('title', 'Platform Rules')

@section('content')

<div class="card p-3">
    <p>
        <strong>About Recharge:</strong> The platform will change the recharge method from time to time.
        Each user should check the latest recharge method before recharging to avoid failures.
    </p>
    
    <p>
        <strong>About Withdrawal:</strong> The minimum withdrawal amount of MALL is **20 USDT**, and the minimum deposit is **10 USDT**.
        Withdrawals are processed within **24 hours**.
    </p>
    
    <p>
        <strong>Freezing Orders:</strong> If an order is not delivered within **10 minutes**, the order will be **frozen**.
    </p>

    <p>
        <strong>Account Policy:</strong> Only **one account per mobile number** is allowed. 
        Multiple accounts may lead to an **account freeze** due to suspected money laundering.
    </p>
</div>

@endsection
