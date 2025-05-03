@extends('layouts.client_master') 

@section('content')
<style>
/* Common Styles */
.records-container {
    padding: 1.5rem;
    background: #f8f9fa;
    min-height: 100vh;
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

/* Tab Navigation */
.nav-tabs {
    border: none;
    margin-bottom: 2rem;
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.nav-link {
    color: #4B5563;
    background: white;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    padding: 0.75rem 2rem;
    font-weight: 500;
    transition: all 0.3s ease;
    min-width: 140px;
    text-align: center;
}

.nav-link:hover {
    color: #3B82F6;
    border-color: #3B82F6;
    background: #EBF5FF;
}

.nav-link.active {
    color: white;
    background: #3B82F6;
    border-color: #3B82F6;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
}

/* Order Card Styles */
.order-card {
    background: white;
    border-radius: 12px;
    border: 1px solid #E5E7EB;
    margin-bottom: 1.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.order-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.order-header {
    padding: 1.25rem;
    border-bottom: 1px solid #E5E7EB;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-title {
    color: #1F2937;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.order-date {
    color: #6B7280;
    font-size: 0.9rem;
}

/* Product List */
.product-list {
    padding: 1.25rem;
    border-bottom: 1px solid #E5E7EB;
}

.product-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #F9FAFB;
    border-radius: 8px;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.product-item:last-child {
    margin-bottom: 0;
}

.product-item:hover {
    background: #F3F4F6;
}

.product-image {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 1rem;
}

.product-details {
    flex: 1;
}

.product-title {
    color: #1F2937;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.product-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product-price {
    color: #3B82F6;
    font-weight: 600;
}

.product-quantity {
    color: #6B7280;
    font-size: 0.9rem;
}

/* Order Footer */
.order-footer {
    padding: 1.25rem;
    background: #F9FAFB;
}

.order-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.order-summary:last-child {
    margin-bottom: 1rem;
}

.summary-label {
    color: #6B7280;
}

.summary-value {
    color: #1F2937;
    font-weight: 500;
}

.summary-value.highlight {
    color: #E67E22;
    font-weight: 600;
}

.submit-order-btn {
    width: 100%;
    padding: 0.875rem;
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.submit-order-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.submit-order-btn i {
    font-size: 1.1rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: #6B7280;
}

.empty-state i {
    font-size: 3rem;
    color: #E5E7EB;
    margin-bottom: 1rem;
}

.empty-state p {
    font-size: 1rem;
    margin: 0;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .records-container {
        padding: 1rem;
    }
    
    .nav-link {
        padding: 0.625rem 1.5rem;
        min-width: 120px;
    }
    
    .product-image {
        width: 60px;
        height: 60px;
    }
    
    .product-title {
        font-size: 0.95rem;
    }
    
    .order-summary {
        font-size: 0.9rem;
    }
}
</style>

<div class="records-container">
    <!-- Page Title -->
    <h3 class="page-title">
        <i class="fas fa-list-alt"></i>
        {{ __('messages.record_list') }}
    </h3>
    
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="menuTabs">
        <li class="nav-item">
            <a class="nav-link active" data-category="incomplete" href="#">
                <i class="fas fa-clock me-2"></i>
                {{ __('messages.incomplete') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-category="complete" href="#">
                <i class="fas fa-check-circle me-2"></i>
                {{ __('messages.complete') }}
            </a>
        </li>
    </ul>
    
    <!-- Orders List -->
    <div id="menuList">
        <!-- Orders will be loaded here dynamically -->
    </div>
</div>

<script>
    function handleOrder(button) {
        const orderData = {
            order_number: button.getAttribute('data-order'),
            total_amount: parseFloat(button.getAttribute('data-total')),
            commission: parseFloat(button.getAttribute('data-commission')),
            expected_income: parseFloat(button.getAttribute('data-expected_income')),
            order_items: JSON.parse(button.getAttribute('data-products').replace(/'/g, '"')).map(product => ({
                product_id: String(product.id || ''),
                quantity: parseInt(product.quantity || 6),
                name: product.name || '',
                image: product.image || '',
                price: parseFloat(product.price || 0)
            }))
        };

        // Show loading state
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __('messages.submitting') }}...';

        fetch('/client/submit-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(orderData)
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) {
                if (response.status === 403 && data.need_balance) {
                    showErrorMessage(data.message);
                    button.disabled = false;
                    button.innerHTML = '{{ __('messages.submit_order') }}';
                    return;
                }
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }
            return data;
        })
        .then(data => {
            if (data && data.success) {
                // Show success message
                const toast = document.createElement('div');
                toast.className = 'alert alert-success position-fixed start-50 top-50 translate-middle m-3';
                toast.style.zIndex = '1050';
                toast.innerHTML = '<i class="fas fa-check-circle me-2"></i>{{ __('messages.order_submitted_successfully') }}';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
                location.reload();
            }else{
                showErrorMessage(data.message);
                button.disabled = false;
                button.innerHTML = '{{ __('messages.submit_order') }}';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorMessage(error.message);
            
            // Reset button
            button.disabled = false;
            button.innerHTML = '{{ __('messages.submit_order') }}';
        });
    }

    function showErrorMessage(message) {
        const toast = document.createElement('div');
        toast.className = 'alert alert-danger position-fixed start-50 top-50 translate-middle';
        toast.style.zIndex = '1050';
        toast.style.minWidth = '300px';
        toast.style.maxWidth = '80%';
        toast.style.width = 'auto';
  
        toast.style.textAlign = 'center';
        toast.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".nav-link");

        function loadOrders(category) {
            const status = category === 'incomplete' ? 'pending' : 'completed';
            const menuList = document.getElementById('menuList');
            
            // Show loading state
            menuList.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                    <p class="mt-2">{{ __('messages.http://127.0.0.1:8000/uploads/medicins/img130.jpg') }}...</p>
                </div>
            `;

            fetch(`/client/orders?status=${status}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.orders.length > 0) {
                    menuList.innerHTML = data.orders.map(order => `
                        <div class="order-card">
                            <div class="order-header">
                                <h5 class="order-title">{{ __('messages.order') }} #${order.order_number}</h5>
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
                                    <span class="summary-label">{{ __('messages.transaction_time') }}</span>
                                    <span class="summary-value">${new Date(order.created_at).toLocaleString()}</span>
                                </div>
                                <div class="order-summary">
                                    <span class="summary-label">{{ __('messages.order_amount') }}</span>
                                    <span class="summary-value">${order.total_amount} USDT</span>
                                </div>
                                <div class="order-summary">
                                    <span class="summary-label">{{ __('messages.commission') }}</span>
                                    <span class="summary-value">${order.commission} USDT</span>
                                </div>
                                <div class="order-summary">
                                    <span class="summary-label">{{ __('messages.expected_income') }}</span>
                                    <span class="summary-value highlight">${order.expected_income} USDT</span>
                                </div>
                                ${category === 'incomplete' ? `
                                    <button class="submit-order-btn" 
                                        data-order="${order.order_number}"
                                        data-total="${order.total_amount}"
                                        data-commission="${order.commission}"
                                        data-expected_income="${order.expected_income}"
                                        data-products='${JSON.stringify(order.products).replace(/'/g, "\\'")}'
                                        onclick="handleOrder(this)">
                                        <i class="fas fa-paper-plane"></i>
                                        {{ __('messages.submit_order') }}
                                    </button>
                                ` : ''}
                            </div>
                        </div>
                    `).join('');
                } else {
                    menuList.innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>{{ __('messages.no_orders_found') }}</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                menuList.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-exclamation-circle"></i>
                        <p>{{ __('messages.failed_to_load_orders') }}</p>
                    </div>
                `;
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener("click", function(event) {
                event.preventDefault();
                const category = this.getAttribute("data-category");
                
                tabs.forEach(t => t.classList.remove("active"));
                this.classList.add("active");
                
                loadOrders(category);
            });
        });

        // Load incomplete orders by default
        loadOrders('incomplete');
    });
</script>
@endsection
