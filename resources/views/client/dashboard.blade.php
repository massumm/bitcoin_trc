@extends('layouts.client_master')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Top Menu (Recharge, Withdrawal, Teams, Invitation) -->
    <div class="row text-center my-3">
        <div class="col">
            <a href="">
                <i class="fas fa-chart-line fa-2x"></i>
                <p>Recharge</p>
            </a>
        </div>
        <div class="col">
            <a href="">
                <i class="fas fa-wallet fa-2x"></i>
                <p>Withdrawal</p>
            </a>
        </div>
        <div class="col">
            <a href="">
                <i class="fas fa-users fa-2x"></i>
                <p>Teams</p>
            </a>
        </div>
        <div class="col">
            <a href="">
                <i class="fas fa-user-plus fa-2x"></i>
                <p>Invitation</p>
            </a>
        </div>
    </div>

    <!-- Wallet Balance -->
    <div class="text-center">
        <h3>Balance: <span class="text-success">125.74 USDT</span></h3>
    </div>

    <!-- Platform Introduction -->
    <h4 class="mt-3">Platform Introduction</h4>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <img src="{{ asset('assets/img/platform_profile.jpg') }}" class="card-img-top" alt="Profile">
                <div class="card-body">
                    <p class="card-text">Platform Profile</p>
                </div>
            </div>
        </div>
        <div class="col-6">
        <a href="{{ route('platform.rules') }}" >
    <div class="card">
        <img src="{{ asset('assets/img/platform_rules.jpg') }}" class="card-img-top" alt="Rules">
        <div class="card-body">
            <p class="card-text">Platfm Rules</p>
        </div>
    </div>
</a>
        </div>
        <div class="col-6">
            <div class="card">
                <img src="{{ asset('assets/img/winwin.jpg') }}" class="card-img-top" alt="Win-Win">
                <div class="card-body">
                    <p class="card-text">Win-Win Cooperation</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <img src="{{ asset('assets/img/instructions.jpg') }}" class="card-img-top" alt="Instructions">
                <div class="card-body">
                    <p class="card-text">Instructions for Use</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
