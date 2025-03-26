@extends('layouts.client_master')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Top Section: User Info -->
    <div class="bg-primary text-white p-3 rounded d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/img/profile.jpg') }}" class="rounded-circle me-2" width="50" height="50" alt="User Image">
            <div>
                <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                <p class="mb-0">Invitation Code: <strong>{{ Auth::user()->refer_code }}</strong></p>
            </div>
        </div>
        <a  class="text-white">
            <i class="fas fa-comment-dots fa-2x"></i>
        </a>
    </div>

    <!-- Account Balance & Actions -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <p class="mb-1 text-muted">My Account</p>
            <h4 class="mb-0">Balance: <span class="text-success">{{ Auth::user()->balance }}</span></h4>
        </div>
        <div class="d-flex">
            <a href="/client/mine/deposit" class="btn btn-outline-primary me-2">
                <img src="{{ asset('assets/img/wallet.png') }}" width="24" height="24" class="me-1"> Deposit
            </a>
            <a href="/client/mine/withdraw" class="btn btn-outline-danger">
                <img src="{{ asset('assets/img/wallet.png') }}" width="24" height="24" class="me-1"> Withdrawal
            </a>
        </div>
    </div>

    <!-- Section: Quick Actions -->
    <div class="row text-center mt-4">
        <div class="col-3">
            <!-- <a href="/client/mine/team" class="d-block text-dark"> -->
            <a class="d-block text-dark">
                <i class="fas fa-users fa-2x"></i>
                <p class="mt-1">Teams</p>
            </a>
        </div>
        <div class="col-3">
            <a  class="d-block text-dark">
                <i class="fas fa-history fa-2x"></i>
                <p class="mt-1">Record</p>
            </a>
        </div>
        <div class="col-3">
            <a class="d-block text-dark">
                <i class="fas fa-wallet fa-2x"></i>
                <p class="mt-1">Wallet Management</p>
            </a>
        </div>
        <div class="col-3">
        <a href="/client/mine/invite_friend" class="d-block text-dark">
            <!-- <a href="/client/mine/invite_friend" class="d-block text-dark"> -->
                <i class="fas fa-user-plus fa-2x"></i>
                <p class="mt-1">Invite Friends</p>
            </a>
        </div>
    </div>

    <!-- Vertical List -->
    <div class="mt-4">
        <div class="list-group">
            <a href="/client/mine/profile" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-user me-2"></i> Profile
            </a>
            <a href="/client/mine/deposit_recordlist" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-file-invoice-dollar me-2"></i> Deposit Records
            </a>
            <a href="/client/mine/withdraw_recordlist" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-money-bill-wave me-2"></i> Withdrawal Records
            </a>
            <a  href="/client/setting"  class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-cog me-2"></i> Settings
            </a>
        </div>
    </div>

</div>

@endsection
