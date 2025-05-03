@extends('layouts.client_master')
@section('content')

<style>
/* Common Styles */
.dashboard-container {
    padding: 1rem;
    background: #f8f9fa;
    height: calc(100vh - 62px); /* Subtract header height */
    overflow: hidden;
}

/* Balance Card */
.balance-card {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    border-radius: 12px;
    padding: 1rem;
    color: white;
    margin-bottom: 1rem;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
}

.balance-card h2 {
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
    opacity: 0.9;
}

.balance-card .balance-amount {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 0;
}

/* Menu Cards */
.menu-section {
    margin-bottom: 1rem;
}

.menu-card {
    background: white;
    border-radius: 8px;
    padding: 0.75rem;
    height: 90px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.menu-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-color: #3B82F6;
}

.menu-card i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: #3B82F6;
}

.menu-card p {
    margin: 0;
    color: #1F2937;
    font-size: 0.85rem;
    font-weight: 500;
}

/* Platform Cards */
.platform-section {
    margin-top: 1rem;
}

.section-title {
    color: #1F2937;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 0.5rem;
    color: #3B82F6;
}

.platform-card {
    height: 160px;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.platform-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.platform-card .card-img-top {
    height: 100px;
    object-fit: cover;
}

.platform-card .card-body {
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    background: white;
}

.platform-card .card-text {
    margin: 0;
    font-size: 0.85rem;
    color: #1F2937;
    font-weight: 500;
    text-align: center;
}

.platform-card-link {
    text-decoration: none;
    display: block;
}

/* Row Spacing */
.row {
    --bs-gutter-y: 0.75rem;
    --bs-gutter-x: 0.75rem;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .dashboard-container {
        height: 100vh;
        overflow-y: auto;
    }
    
    .menu-card {
        height: 80px;
        padding: 0.5rem;
    }
    
    .platform-card {
        height: 160px;
    }
    
    .platform-card .card-img-top {
        height: 100px;
    }
}
</style>

<div class="dashboard-container">
    <!-- Balance Card -->
    <div class="balance-card">
        <h2>Total Balance</h2>
        <p class="balance-amount">{{ Auth::user()->balance }} USDT</p>
    </div>

    <!-- Menu Section -->
    <div class="menu-section">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <a href="/client/mine/deposit_recordlist" class="text-decoration-none">
                    <div class="menu-card">
                        <i class="fas fa-chart-line"></i>
                        <p>{{ __('messages.deposit_records') }}</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="/client/mine/withdraw_recordlist" class="text-decoration-none">
                    <div class="menu-card">
                        <i class="fas fa-wallet"></i>
                        <p>{{ __('messages.withdrawal_records') }}</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="/client/mine/team" class="text-decoration-none">
                    <div class="menu-card">
                        <i class="fas fa-users"></i>
                        <p>{{ __('messages.team') }}</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="/client/mine/invite_friend" class="text-decoration-none">
                    <div class="menu-card">
                        <i class="fas fa-user-plus"></i>
                        <p>{{ __('messages.invite_friends') }}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Platform Section -->
    <div class="platform-section">
        <h4 class="section-title">
            <i class="fas fa-building"></i>
            Platform Introduction
        </h4>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <a href="{{ route('platform.profiles') }}" class="platform-card-link">
                    <div class="card platform-card">
                        <img src="{{ asset('assets/img/office_desk.jpg') }}" class="card-img-top" alt="Profile">
                        <div class="card-body">
                            <p class="card-text">Platform Profile</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('platform.rules') }}" class="platform-card-link">
                    <div class="card platform-card">
                        <img src="{{ asset('assets/img/highway.jpeg') }}" class="card-img-top" alt="Rules">
                        <div class="card-body">
                            <p class="card-text">Platform Rules</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('platform.cooperation') }}" class="platform-card-link">
                    <div class="card platform-card">
                        <img src="{{ asset('assets/img/handshake.jpg') }}" class="card-img-top" alt="Win-Win">
                        <div class="card-body">
                            <p class="card-text">Win-Win Cooperation</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('platform.instruction') }}" class="platform-card-link">
                    <div class="card platform-card">
                        <img src="{{ asset('assets/img/instruction.jpeg') }}" class="card-img-top" alt="Instructions">
                        <div class="card-body">
                            <p class="card-text">Instructions for Use</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
