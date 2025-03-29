@extends('layouts.client_master')
@section('content')

<style>
    .menu-image-container {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
        border-radius: 8px;
    }
    
    .menu-image {
        max-width: 100%;
        max-height: 100%;
        width: 70px;
        height: 70px;
        object-fit: contain;
    }
    
    .menu-content {
        flex: 1;
        padding-left: 10px;
    }
    
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Tab styling */
    .nav-tabs .nav-link {
        color: #495057;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        margin-right: 5px;
        transition: all 0.3s ease;
    }
    
    .nav-tabs .nav-link.active {
        color: white;
        background-color: #3B82F6;
        border-color: #3B82F6;
    }
    
    .nav-tabs .nav-link:hover:not(.active) {
        background-color: #e9ecef;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Menu Title -->
    <h3 class="text-center my-3">{{ __('messages.menu') }}</h3>
    
    <!-- Tabs for filtering -->
    <ul class="nav nav-tabs mb-3" id="menuTabs">
        <li class="nav-item">
            <a class="nav-link active" data-category="all" href="#">{{ __('messages.all') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip1" href="#">{{ __('messages.vip1') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip2" href="#">{{ __('messages.vip2') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip3" href="#">{{ __('messages.vip3') }}</a>
        </li>
    </ul>
    
    <!-- List of Items -->
    <div id="menuList">
        <a href="{{ url('/client/projectdetails?id=1&name=Amazon') }}" class="menu-item" data-category="vip1">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <div class="menu-image-container me-3">
                        <img src="{{ asset('assets/img/amazon.jpg') }}" alt="Amazon" class="menu-image">
                    </div>
                    <div class="menu-content">
                        <h5 class="card-title">{{ __('messages.amazon') }}</h5>
                        <p class="card-text">{{ __('messages.available_balance') }}: 20USDT-499USDT</p>
                        <p class="card-text text-danger">{{ __('messages.commissions') }}: 4%</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ url('/client/projectdetails?id=2&name=Alibaba') }}" class="menu-item" data-category="vip2">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <div class="menu-image-container me-3">
                        <img src="{{ asset('assets/img/alibaba.png') }}" alt="Alibaba" class="menu-image">
                    </div>
                    <div class="menu-content">
                        <h5 class="card-title">{{ __('messages.alibaba') }}</h5>
                        <p class="card-text">{{ __('messages.available_balance') }}: 499USDT-899USDT</p>
                        <p class="card-text text-danger">{{ __('messages.commissions') }}: 8%</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ url('/client/projectdetails?id=3&name=Aliexpress') }}" class="menu-item" data-category="vip3">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <div class="menu-image-container me-3">
                        <img src="{{ asset('assets/img/aliexpress.jpeg') }}" alt="Aliexpress" class="menu-image">
                    </div>
                    <div class="menu-content">
                        <h5 class="card-title">{{ __('messages.aliexpress') }}</h5>
                        <p class="card-text">{{ __('messages.available_balance') }}: ≥899USDT</p>
                        <p class="card-text text-danger">{{ __('messages.commissions') }}: 12%</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Script to filter tabs dynamically -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".nav-link");
        const items = document.querySelectorAll(".menu-item");

        tabs.forEach(tab => {
            tab.addEventListener("click", function(event) {
                event.preventDefault();
                const category = this.getAttribute("data-category");
                
                tabs.forEach(t => t.classList.remove("active"));
                this.classList.add("active");
                
                items.forEach(item => {
                    if (category === "all" || item.getAttribute("data-category") === category) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    });
</script>

@endsection
