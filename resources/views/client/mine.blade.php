@extends('layouts.client_master')
@section('content')

<style>
/* Common Styles */
.profile-container {
    padding: 1.5rem;
    background: #f8f9fa;
    min-height: 100vh;
}

/* Profile Header Card */
.profile-header {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
}

.profile-header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.profile-info {
    position: relative;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.profile-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    border: 3px solid rgba(255, 255, 255, 0.2);
    object-fit: cover;
}

.vip-badge {
    height: 20px;
    object-fit: cover;
    margin-left: 1px;
}

.profile-details h5 {
    color: white;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.profile-details p {
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    font-size: 0.95rem;
}

.profile-action i {
    color: white;
    opacity: 0.9;
    transition: all 0.3s ease;
}

.profile-action:hover i {
    opacity: 1;
    transform: scale(1.1);
}

/* Balance Section */
.balance-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.balance-label {
    color: #6B7280;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
}

.balance-amount {
    color: #1F2937;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.balance-amount .amount {
    color: #059669;
}

.action-buttons {
    display: flex;
    gap: 1rem;
}

.action-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.action-btn img {
    width: 24px;
    height: 24px;
    margin-right: 0.5rem;
}

.deposit-btn {
    background: #EBF5FF;
    color: #3B82F6;
    border: 1px solid #BFDBFE;
}

.deposit-btn:hover {
    background: #DBEAFE;
    border-color: #3B82F6;
}

.withdraw-btn {
    background: #FEF2F2;
    color: #DC2626;
    border: 1px solid #FECACA;
}

.withdraw-btn:hover {
    background: #FEE2E2;
    border-color: #DC2626;
}

/* Quick Actions Grid */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    align-content: center;
    gap: 1.75rem;
    margin-bottom: 1.5rem;
}

.quick-action-item {
    background: white;
    border-radius: 12px;
    padding: 1rem 0.5rem;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid #E5E7EB;
}

.quick-action-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-color: #3B82F6;
}

.quick-action-item i {
    font-size: 2rem;
    color: #3B82F6;
    margin-bottom: 0.75rem;
}

.quick-action-item p {
    margin: 0;
    color: #4B5563;
    font-size: 1rem;
    font-weight: 500;
}

/* Menu List */
.menu-list {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.menu-item {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    text-decoration: none;
    color: #1F2937;
    border-bottom: 1px solid #E5E7EB;
    transition: all 0.3s ease;
}

.menu-item:last-child {
    border-bottom: none;
}

.menu-item:hover {
    background: #F3F4F6;
}

.menu-item i {
    width: 24px;
    margin-right: 1rem;
    color: #3B82F6;
    font-size: 1.1rem;
}

.menu-item span {
    font-size: 0.95rem;
    font-weight: 500;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .profile-container {
        padding: 1rem;
    }
    
    .profile-avatar {
        width: 48px;
        height: 48px;
    }
    
    .profile-details h5 {
        font-size: 1.1rem;
    }
    
    .quick-actions {
        gap: 1.75rem;
        margin-bottom: 0.5rem;
    }
    
    .quick-action-item {
        padding: 1rem;
    }
    
    .quick-action-item i {
        font-size: 1.5rem;
    }
    
    .quick-action-item p {
        font-size: 0.9rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-btn {
        width: 100%;
    }
}
</style>

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-header-content">
            <div class="profile-info">
                <img src="{{ asset('assets/img/profile.jpg') }}" class="profile-avatar" alt="User Image">
             
                <div class="profile-details">
                    <h5 >{{ Auth::user()->name }}    @if(Auth::user()->balance >= 899)
                    <img src="{{ asset('assets/img/vip3.png') }}" class="vip-badge" alt="VIP 3">
                @elseif(Auth::user()->balance >= 499)
                    <img src="{{ asset('assets/img/vip2.png') }}" class="vip-badge" alt="VIP 2">
                @elseif(Auth::user()->balance >= 21)
                    <img src="{{ asset('assets/img/vip1.jpg') }}" class="vip-badge" alt="VIP 1">
                @else
                    <img src="{{ asset('assets/img/vip0.png') }}" class="vip-badge" alt="VIP 0">
                @endif</h5>
                    <p>{{ __('messages.invitation_code') }}: {{ Auth::user()->refer_code }}</p>
                </div>
            </div>
            <!-- <a href="#" class="profile-action">
                <i class="fas fa-comment-dots fa-2x"></i>
            </a> -->
        </div>
    </div>

    <!-- Balance Section -->
    <div class="balance-section">
        <p class="balance-label">{{ __('messages.my_account') }}</p>
        <h4 class="balance-amount">{{ __('messages.balance') }}: <span class="amount">{{ Auth::user()->balance }}</span></h4>
        <div class="action-buttons">
            <a href="/client/mine/deposit" class="action-btn deposit-btn">
                <img src="{{ asset('assets/img/wallet.png') }}" alt="Deposit">
                {{ __('messages.deposit') }}
            </a>
            <a href="/client/mine/withdraw" class="action-btn withdraw-btn">
                <img src="{{ asset('assets/img/wallet.png') }}" alt="Withdraw">
                {{ __('messages.withdrawal') }}
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="/client/mine/team" class="quick-action-item">
            <i class="fas fa-users"></i>
            <p>{{ __('messages.team') }}</p>
        </a>
        <!-- <a href="#" class="quick-action-item">
            <i class="fas fa-history"></i>
            <p>{{ __('messages.record') }}</p>
        </a> -->
        <a href="/client/mine/card_manage" class="quick-action-item">
            <i class="fas fa-wallet"></i>
            <p>{{ __('messages.wallet_management') }}</p>
        </a>
        <a href="/client/mine/invite_friend" class="quick-action-item">
            <i class="fas fa-user-plus"></i>
            <p>{{ __('messages.invite_friends') }}</p>
        </a>
    </div>

    <!-- Menu List -->
    <div class="menu-list">
        <a href="/client/mine/profile" class="menu-item">
            <i class="fas fa-user"></i>
            <span>{{ __('messages.profile') }}</span>
        </a>
        <a href="/client/mine/deposit_recordlist" class="menu-item">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>{{ __('messages.deposit_records') }}</span>
        </a>
        <a href="/client/mine/withdraw_recordlist" class="menu-item">
            <i class="fas fa-money-bill-wave"></i>
            <span>{{ __('messages.withdrawal_records') }}</span>
        </a>
        <a href="/client/setting" class="menu-item">
            <i class="fas fa-cog"></i>
            <span>{{ __('messages.settings') }}</span>
        </a>
    </div>
</div>

@endsection
