@extends('layouts.client_master')
@section('content')

<style>
/* Common Styles */
.menu-container {
    padding: 1.5rem;
    background: #f8f9fa;
}

.page-title {
    color: #1F2937;
    font-size: 1.5rem;
    font-weight: 600;
    text-align: center;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.page-title i {
    margin-right: 0.75rem;
    color: #3B82F6;
}

/* Tab Styling */
.nav-tabs {
    border: none;
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center;
    gap: 0.5rem;
}

.nav-tabs .nav-link {
    color: #4B5563;
    background: white;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
    color: #3B82F6;
    border-color: #3B82F6;
    background: #EBF5FF;
}

.nav-tabs .nav-link.active {
    color: white;
    background: #3B82F6;
    border-color: #3B82F6;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.1);
}

/* Menu Item Cards */
.menu-card {
    background: white;
    border-radius: 12px;
    border: 1px solid #E5E7EB;
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    text-decoration: none;
    display: block;
}

.menu-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-color: #3B82F6;
}

.menu-card-body {
    padding: 1.25rem;
    display: flex;
    align-items: center;
}

.menu-image-container {
    width: 90px;
    height: 90px;
    background: #F3F4F6;
    border-radius: 10px;
    padding: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1.25rem;
}

.menu-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.menu-content {
    flex: 1;
}

.menu-title {
    color: #1F2937;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.menu-text {
    color: #4B5563;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.menu-text i {
    margin-right: 0.5rem;
    color: #3B82F6;
    font-size: 0.9rem;
}

.commission-text {
    color: #DC2626;
    font-weight: 500;
    display: flex;
    align-items: center;
}

.commission-text i {
    margin-right: 0.5rem;
    font-size: 0.9rem;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .menu-container {
        padding: 1rem;
    }
    
    .nav-tabs .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .menu-image-container {
        width: 70px;
        height: 70px;
    }
    
    .menu-title {
        font-size: 1rem;
    }
    
    .menu-text {
        font-size: 0.9rem;
    }
}
</style>

<div class="menu-container">
    <!-- Page Title -->
    <h3 class="page-title">
        <i class="fas fa-store"></i>
        {{ __('messages.menu') }}
    </h3>
    
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="menuTabs">
        <li class="nav-item">
            <a class="nav-link active" data-category="all" href="#">
                <i class="fas fa-th-large"></i> {{ __('messages.all') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip1" href="#">
                <i class="fas fa-star"></i> {{ __('messages.vip1') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip2" href="#">
                <i class="fas fa-star"></i> {{ __('messages.vip2') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip3" href="#">
                <i class="fas fa-star"></i> {{ __('messages.vip3') }}
            </a>
        </li>
    </ul>
    
    <!-- Menu Items -->
    <div id="menuList">
        <a href="{{ url('/client/projectdetails?id=1&name=Amazon') }}" class="menu-card menu-item" data-category="vip1">
            <div class="menu-card-body">
                <div class="menu-image-container">
                    <img src="{{ asset('assets/img/amazon.jpg') }}" alt="Amazon" class="menu-image">
                </div>
                <div class="menu-content">
                    <h5 class="menu-title">{{ __('messages.amazon') }}</h5>
                    <p class="menu-text">
                        <i class="fas fa-wallet"></i>
                        {{ __('messages.available_balance') }}: 20USDT-499USDT
                    </p>
                    <p class="menu-text commission-text">
                        <i class="fas fa-percentage"></i>
                        {{ __('messages.commissions') }}: 4%
                    </p>
                </div>
            </div>
        </a>

        <a href="{{ url('/client/projectdetails?id=2&name=Alibaba') }}" class="menu-card menu-item" data-category="vip2">
            <div class="menu-card-body">
                <div class="menu-image-container">
                    <img src="{{ asset('assets/img/alibaba.png') }}" alt="Alibaba" class="menu-image">
                </div>
                <div class="menu-content">
                    <h5 class="menu-title">{{ __('messages.alibaba') }}</h5>
                    <p class="menu-text">
                        <i class="fas fa-wallet"></i>
                        {{ __('messages.available_balance') }}: 499USDT-899USDT
                    </p>
                    <p class="menu-text commission-text">
                        <i class="fas fa-percentage"></i>
                        {{ __('messages.commissions') }}: 8%
                    </p>
                </div>
            </div>
        </a>

        <a href="{{ url('/client/projectdetails?id=3&name=Aliexpress') }}" class="menu-card menu-item" data-category="vip3">
            <div class="menu-card-body">
                <div class="menu-image-container">
                    <img src="{{ asset('assets/img/aliexpress.jpeg') }}" alt="Aliexpress" class="menu-image">
                </div>
                <div class="menu-content">
                    <h5 class="menu-title">{{ __('messages.aliexpress') }}</h5>
                    <p class="menu-text">
                        <i class="fas fa-wallet"></i>
                        {{ __('messages.available_balance') }}: ≥899USDT
                    </p>
                    <p class="menu-text commission-text">
                        <i class="fas fa-percentage"></i>
                        {{ __('messages.commissions') }}: 12%
                    </p>
                </div>
            </div>
        </a>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".nav-link");
    const items = document.querySelectorAll(".menu-item");

    tabs.forEach(tab => {
        tab.addEventListener("click", function(event) {
            event.preventDefault();
            const category = this.getAttribute("data-category");
            
            // Update active state
            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");
            
            // Filter items with animation
            items.forEach(item => {
                if (category === "all" || item.getAttribute("data-category") === category) {
                    item.style.display = "block";
                    setTimeout(() => {
                        item.style.opacity = "1";
                        item.style.transform = "translateY(0)";
                    }, 50);
                } else {
                    item.style.opacity = "0";
                    item.style.transform = "translateY(20px)";
                    setTimeout(() => {
                        item.style.display = "none";
                    }, 300);
                }
            });
        });
    });
});
</script>

@endsection
