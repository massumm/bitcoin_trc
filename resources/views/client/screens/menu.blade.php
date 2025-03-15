@extends('layouts.client_master')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Menu Title -->
    <h3 class="text-center my-3">Menu</h3>
    
    <!-- Tabs for filtering -->
    <ul class="nav nav-tabs mb-3" id="menuTabs">
        <li class="nav-item">
            <a class="nav-link active" data-category="all" href="#">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip1" href="#">VIP 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip2" href="#">VIP 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="vip3" href="#">VIP 3</a>
        </li>
    </ul>
    
    <!-- List of Items -->
    <div id="menuList">
        <a href="{{ url('/client/projectdetails?id=1&name=Amazon') }}" class="menu-item" data-category="vip1">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Amazon</h5>
                    <p class="card-text">Available balance: 20USDT-499USDT</p>
                    <p class="card-text text-danger">Commissions: 4%</p>
                </div>
            </div>
        </a>
        <a href="{{ url('/client/projectdetails?id=2&name=Alibaba') }}" class="menu-item" data-category="vip2">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Alibaba</h5>
                    <p class="card-text">Available balance: 499USDT-899USDT</p>
                    <p class="card-text text-danger">Commissions: 8%</p>
                </div>
            </div>
        </a>
        <a href="{{ url('/client/projectdetails?id=3&name=Aliexpress') }}" class="menu-item" data-category="vip3">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Aliexpress</h5>
                    <p class="card-text">Available balance: ≥899USDT</p>
                    <p class="card-text text-danger">Commissions: 12%</p>
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
