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
        <!-- Orders will be loaded here dynamically -->
    </div>
</div>

<!-- JavaScript Code -->
<script>
    function handleOrder(button) {
        const orderData = {
            order_number: button.getAttribute('data-order'),
            total_amount: parseFloat(button.getAttribute('data-total')),
            commission: parseFloat(button.getAttribute('data-commission')),
            expected_income: parseFloat(button.getAttribute('data-expected_income')),
            order_items: JSON.parse(button.getAttribute('data-products')).map(product => ({
                product_id: product.id,
                quantity: product.quantity,
                image: product.image,
                price: product.price,
                name: product.name
            }))
        };

        fetch('/client/submit-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order submitted successfully!');
                //loadOrders('incomplete');  // Reload orders after submission
            } else {
                alert('Failed to submit order: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error submitting order:', error);
            alert('Failed to submit order. Please try again.');
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".nav-link");

        function updateActiveTab(selectedTab) {
            tabs.forEach(tab => {
                tab.classList.remove("active");
                tab.style.borderBottom = "none";
            });
            selectedTab.classList.add("active");
            selectedTab.style.borderBottom = "3px solid blue";
        }

        function loadOrders(category) {
            const status = category === 'incomplete' ? 'pending' : 'completed';
            fetch(`/client/orders?status=${status}`)
            .then(response => response.json())
            .then(data => {
                const menuList = document.getElementById('menuList');
                if (data.success && data.orders.length > 0) {
                    menuList.innerHTML = data.orders.map(order => `
                        <div class="menu-item" data-category="${category}">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="order-header">
                                        <h5 class="card-title">Order ${order.order_number}</h5>
                                        <span class="order-date">${new Date(order.created_at).toLocaleString()}</span>
                                    </div>
                                    <div class="product-list">
                                        ${order.products.map(product => `
                                            <div class="product-item">
                                                <img src="{{ asset('${product.image}') }}" class="product-image" alt="${product.name}">
                                                <div class="product-details">
                                                    <h3 class="product-title">${product.name}</h3>
                                                    <div class="product-info">
                                                        <span class="product-price">${product.price} USDT</span>
                                                        <span class="product-quantity">x${product.quantity}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        `).join('')}
                                    </div>
                                    <div class="order-footer">
                                        <div class="order-summary">
                                            <span>Transaction time</span>
                                            <span>${new Date(order.created_at).toLocaleString()}</span>
                                        </div>
                                        <div class="order-summary">
                                            <span>Order amount</span>
                                            <span>${order.total_amount} USDT</span>
                                        </div>
                                        <div class="order-summary">
                                            <span>Commissions</span>
                                            <span>${order.commission} USDT</span>
                                        </div>
                                        <div class="order-summary">
                                            <span>Expected income</span>
                                            <span style="color: #E67E22;">${order.expected_income} USDT</span>
                                        </div>
                                        ${category === 'incomplete' ? `
                                            <button class="submit-order-btn" 
                                                data-order="${order.order_number}"
                                                data-total="${order.total_amount}"
                                                data-commission="${order.commission}"
                                                data-expected_income="${order.expected_income}"
                                                data-products='${JSON.stringify(order.products).replace(/'/g, "\\'")}'
                                                onclick="handleOrder(this)">
                                                Submit order
                                            </button>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');
                } else {
                    menuList.innerHTML = '<p class="text-center">No orders found</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching orders:', error);
                menuList.innerHTML = '<p class="text-center text-danger">Failed to load orders</p>';
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener("click", function(event) {
                event.preventDefault();
                const category = this.getAttribute("data-category");
                updateActiveTab(this);
                loadOrders(category);
            });
        });

        // Load incomplete orders by default
        loadOrders('incomplete');
    });
</script>

<style>
.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.order-date {
    color: #666;
    font-size: 0.9rem;
}

.product-list {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 1rem 0;
}

.product-item {
    display: flex;
    align-items: center;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 4px;
    margin-bottom: 0.5rem;
}

.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
    margin-right: 1rem;
}

.product-details {
    flex: 1;
}

.product-title {
    font-size: 1rem;
    margin-bottom: 0.5rem;
    color: #333;
}

.product-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product-price {
    font-weight: bold;
    color: #333;
}

.product-quantity {
    color: #666;
}

.order-footer {
    margin-top: 1rem;
}

.order-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.order-summary span:first-child {
    color: #666;
}

.order-summary span:last-child {
    font-weight: 500;
}

.submit-order-btn {
    width: 100%;
    padding: 0.75rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 500;
    margin-top: 1rem;
    cursor: pointer;
    transition: background-color 0.2s;
}

.submit-order-btn:hover {
    background-color: #0056b3;
}
</style>
@endsection
