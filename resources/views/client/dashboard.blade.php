@extends('layouts.client_master')
@section('content')

<style>
/* Common Styles */
.dashboard-container {
    padding: 1.5rem;
    background: #f8f9fa;
}

/* Balance Card */
.balance-card {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    border-radius: 16px;
    padding: 2rem;
    color: white;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
}

.balance-card h2 {
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    opacity: 0.9;
}

.balance-card .balance-amount {
    font-size: 2.5rem;
    font-weight: 600;
    margin-bottom: 0;
}

/* Menu Cards */
.menu-section {
    margin-bottom: 2rem;
}

.menu-card {
    background: white;
    border-radius: 12px;
    padding: 1.25rem;
    height: 120px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.menu-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-color: #3B82F6;
}

.menu-card i {
    font-size: 1.75rem;
    margin-bottom: 0.75rem;
    color: #3B82F6;
    transition: all 0.3s ease;
}

.menu-card:hover i {
    transform: scale(1.1);
}

.menu-card p {
    margin: 0;
    color: #1F2937;
    font-size: 0.95rem;
    font-weight: 500;
}

/* Platform Cards */
.platform-section {
    margin-top: 2rem;
}

.section-title {
    color: #1F2937;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 0.75rem;
    color: #3B82F6;
}

.platform-card {
    height: 240px;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.platform-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
}

.platform-card .card-img-top {
    height: 170px;
    object-fit: cover;
    transition: all 0.3s ease;
}

.platform-card:hover .card-img-top {
    transform: scale(1.05);
}

.platform-card .card-body {
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    background: white;
}

.platform-card .card-text {
    margin: 0;
    font-size: 1rem;
    color: #1F2937;
    font-weight: 500;
}

.platform-card-link {
    text-decoration: none;
    display: block;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }
    
    .balance-card {
        padding: 1.5rem;
    }
    
    .balance-card .balance-amount {
        font-size: 2rem;
    }
    
    .menu-card {
        height: 100px;
        padding: 1rem;
    }
    
    .platform-card {
        height: 200px;
    }
    
    .platform-card .card-img-top {
        height: 140px;
    }
}
</style>

<div class="dashboard-container">
    <!-- Balance Card -->
    <div class="balance-card">
        <h2>Total Balance</h2>
        <p class="balance-amount">{{ Auth::user()->balance }}</p>
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
            <div class="col-12 col-md-6">
                <a href="{{ route('platform.profiles') }}" class="platform-card-link">
                    <div class="card platform-card">
                        <img src="{{ asset('assets/img/office_desk.jpg') }}" class="card-img-top" alt="Profile">
                        <div class="card-body">
                            <p class="card-text">Platform Profile</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6">
                <a href="{{ route('platform.rules') }}" class="platform-card-link">
                    <div class="card platform-card">
                        <img src="{{ asset('assets/img/highway.jpeg') }}" class="card-img-top" alt="Rules">
                        <div class="card-body">
                            <p class="card-text">Platform Rules</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6">
                <a href="{{ route('platform.cooperation') }}" class="platform-card-link">
                    <div class="card platform-card">
                        <img src="{{ asset('assets/img/handshake.jpg') }}" class="card-img-top" alt="Win-Win">
                        <div class="card-body">
                            <p class="card-text">Win-Win Cooperation</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6">
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
