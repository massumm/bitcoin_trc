@extends('layouts.client_master')
@section('content')

<style>
.menu-card {
    text-align: center;
    padding: 15px;
    height: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.menu-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.menu-card i {
    margin-bottom: 8px;
    color: #3B82F6;
}

.menu-card p {
    margin: 0;
    color: #333;
    font-size: 14px;
}

/* Platform Introduction Cards */
.platform-card {
    height: 224px;
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.platform-card:hover {
    transform: translateY(-5px);
}

.platform-card .card-img-top {
    height: 160px;
    object-fit: cover;
}

.platform-card .card-body {
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
}

.platform-card .card-text {
    margin: 0;
    font-size: 16px;
    color: #333;
}

.platform-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Top Menu (Recharge, Withdrawal, Teams, Invitation) -->
    <div class="row text-center my-3">
        <div class="col">
            <a href="" class="text-decoration-none">
                <div class="menu-card">
                    <i class="fas fa-chart-line fa-2x"></i>
                    <p>Recharge</p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="" class="text-decoration-none">
                <div class="menu-card">
                    <i class="fas fa-wallet fa-2x"></i>
                    <p>Withdrawal</p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="" class="text-decoration-none">
                <div class="menu-card">
                    <i class="fas fa-users fa-2x"></i>
                    <p>Teams</p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="" class="text-decoration-none">
                <div class="menu-card">
                    <i class="fas fa-user-plus fa-2x"></i>
                    <p>Invitation</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Wallet Balance -->
    <div class="text-center">
        <h3>Balance: <span class="text-success">{{ Auth::user()->balance }}</span></h3>
    </div>

    <!-- Platform Introduction -->
    <h4 class="mt-3">Platform Introduction</h4>
    <div class="row">
        <div class="col-6">
            <div class="card platform-card">
                <img src="{{ asset('assets/img/office_desk.jpg') }}" class="card-img-top" alt="Profile">
                <div class="card-body">
                    <p class="card-text">Platform Profile</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <a href="{{ route('platform.rules') }}" class="platform-card-link">
                <div class="card platform-card">
                    <img src="{{ asset('assets/img/highway.jpeg') }}" class="card-img-top" alt="Rules">
                    <div class="card-body">
                        <p class="card-text">Platform Rules</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6">
            <div class="card platform-card">
                <img src="{{ asset('assets/img/handshake.jpg') }}" class="card-img-top" alt="Win-Win">
                <div class="card-body">
                    <p class="card-text">Win-Win Cooperation</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card platform-card">
                <img src="{{ asset('assets/img/instruction.jpeg') }}" class="card-img-top" alt="Instructions">
                <div class="card-body">
                    <p class="card-text">Instructions for Use</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
