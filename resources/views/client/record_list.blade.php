@extends('layouts.client_master')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Menu Title -->
    <h3 class="text-center my-3">RecordList</h3>
    
    <!-- Tabs for filtering -->
    <ul class="nav nav-tabs border-bottom-0 d-flex justify-content-center" id="menuTabs">
        <li class="nav-item">
            <a class="nav-link active position-relative" data-category="incomplete" href="#">Incomplete</a>
        </li>
        <li class="nav-item">
            <a class="nav-link position-relative" data-category="complete" href="#">Complete</a>
        </li>
    </ul>
    
    <!-- List of Items -->
    <div id="menuList">
        <div class="menu-item" data-category="incomplete">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Amazon</h5>
                    <p class="card-text">Available balance: 20USDT-499USDT</p>
                    <p class="card-text text-danger">Commissions: 4%</p>
                </div>
            </div>
        </div>
        <div class="menu-item" data-category="complete">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Alibaba</h5>
                    <p class="card-text">Available balance: 499USDT-899USDT</p>
                    <p class="card-text text-danger">Commissions: 8%</p>
                </div>
            </div>
        </div>
        <div class="menu-item" data-category="complete">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Aliexpress</h5>
                    <p class="card-text">Available balance: ≥899USDT</p>
                    <p class="card-text text-danger">Commissions: 12%</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script to filter tabs dynamically -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".nav-link");
        const items = document.querySelectorAll(".menu-item");

        function updateActiveTab(selectedTab) {
            tabs.forEach(tab => {
                tab.classList.remove("active");
                tab.style.borderBottom = "none";
            });
            selectedTab.classList.add("active");
            selectedTab.style.borderBottom = "3px solid blue";
        }

        tabs.forEach(tab => {
            tab.addEventListener("click", function(event) {
                event.preventDefault();
                const category = this.getAttribute("data-category");

                updateActiveTab(this);

                items.forEach(item => {
                    if (category === "all" || item.getAttribute("data-category") === category) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });

        // Default: Show only "Incomplete" items
        tabs[0].click();
    });
</script>
@endsection
