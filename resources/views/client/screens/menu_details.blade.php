@extends('layouts.minimal')

@section('title', $name ?? __('messages.project_details'))

@section('content')
<style>
    /* Full page background */
    body {
        background-color: #F8F8F8;
    }

    /* Blue gradient header */
    .top-section {
        background: linear-gradient(to right, #4A90E2, #2563eb);
        height: 300px;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
    }

    /* Page container */
    /* .container {
        position: relative;
        top: 60px;
        text-align: center;
    } */

    /* Account balance text */
    .balance {
        color: white;
        font-size: 15px;
        font-weight: 500;
        margin-top: 15px;
    }

    .balance h2 {
        font-size: 28px;
        font-weight: bold;
    }

    /* Centered info card */
    .info-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 400px;
        margin: auto;
        text-align: center;
        position: relative;
       
    }

    .info-card .row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
    }

    /* Order Button */
    .btn-primary {
        display: block;
        width: 80%;
        background: #3B82F6;
        font-size: 18px;
        padding: 12px;
        border-radius: 25px;
        font-weight: bold;
        margin: 10px auto 20px auto;
    }

    /* Hint box */
    .hint-box {
        width: 90%;
        max-width: 400px;
        margin: auto;
        text-align: left;
        font-size: 14px;
        color: #666;
    }

    /* Popup Background */
    .popup-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2);
        display: none;
        justify-content: center;
        align-items: center;
    }

    /* Popup Card */
    .popup-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    /* Close Button */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 18px;
        cursor: pointer;
        color: #555;
    }

    /* Gray Order Details Card */
    .order-details {
        background: #E0E0E0;
        border-radius: 8px;
        padding: 15px;
        margin-top: 10px;
    }

    /* Submit Order Button */
    .btn-submit {
        background: #3B82F6;
        color: white;
        font-size: 16px;
        padding: 10px;
        border-radius: 25px;
        width: 100%;
        margin-top: 20px;
    }

    /* Error Overlay Styling */
    .error-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    
    .error-message {
        background: rgba(220, 53, 69, 0.9);
        color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        max-width: 80%;
    }
    
    .close-error {
        position: absolute;
        top: 10px;
        right: 15px;
        color: white;
        font-size: 24px;
        cursor: pointer;
        background: none;
        border: none;
    }

    .order-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        width: 90%;
        max-width: 400px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .order-header {
        text-align: center;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .order-number {
        color: #E91E63;
        font-size: 16px;
        margin: 0;
    }

    .product-item {
        display: flex;
        padding: 15px;
        border-bottom: 1px solid #f5f5f5;
        align-items: center;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 8px;
    }

    .product-details {
        flex: 1;
    }

    .product-title {
        font-size: 16px;
        margin: 0 0 10px 0;
        color: #333;
    }

    .product-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-price {
        color: #333;
        font-size: 14px;
    }

    .product-quantity {
        color: #666;
        font-size: 14px;
    }

    .order-footer {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 0 0 12px 12px;
    }

    .order-summary {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .submit-order-btn {
        background: #4A90E2;
        color: white;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 500;
    }

    .order-popup .close-popup {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 20px;
        color: #666;
        cursor: pointer;
        background: none;
        border: none;
        padding: 5px;
        z-index: 1001;
    }

    .order-popup .close-popup:hover {
        color: #333;
    }

</style>

<!-- Blue background -->
<div class="top-section"></div>
<div id="productContainer"></div>
<!-- Page Content -->
<div class="container">
    <!-- Page Title --> <!-- Account Balance -->
    <div class="balance">
        <p>{{ __('messages.account_balance') }}:</p>
        <h2><span class="text-success">{{ Auth::user()->balance }}</span> {{ __('messages.usdt') }}</h2>
    </div>

    <!-- Centered Card -->
    <div class="info-card">
        <div class="row">
            <div class="col-6">
                <p>{{ __('messages.today_times') }}</p>
                <h5>{{ Auth::user()->today_task }}</h5>
            </div>
            <div class="col-6">
                <p>{{ __('messages.today_commission') }}</p>
                <h5><span class="text-success">{{ Auth::user()->min_earn }}</span> {{ __('messages.usdt') }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p>{{ __('messages.cash_gap_between_tasks') }}</p>
                <h5>0 {{ __('messages.usdt') }}</h5>
            </div>
            <div class="col-6">
                <p>{{ __('messages.yesterday_buy_commission') }}</p>
                <h5>0 {{ __('messages.usdt') }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p>{{ __('messages.yesterday_team_commission') }}</p>
                <h5>0 {{ __('messages.usdt') }}</h5>
            </div>
            <div class="col-6">
                <p>{{ __('messages.money_frozen_in_accounts') }}</p>
                <h5>0 {{ __('messages.usdt') }}</h5>
            </div>
        </div>
    </div>

    <!-- Grab Order Button -->
    <button class="btn btn-primary" onclick="openPopup()">{{ __('messages.grab_order_immediately') }}</button>

    <!-- Hint Section -->
    <div class="hint-box">
        <h6>{{ __('messages.hint') }}:</h6>
        <p>{{ __('messages.hint_1') }}</p>
        <p>{{ __('messages.hint_2') }}</p>
    </div>
</div>

<!-- Order Popup -->
<div class="popup-bg" id="orderPopup">
    <div class="popup-card">
        <span class="close-btn" onclick="closePopup()">✖</span>
        <h4>{{ __('messages.order_details') }}</h4>

        <div class="order-details">
            <p><strong>{{ __('messages.order_no') }}:</strong> 12345678</p>
            <div class="mt-3">
                <p><strong>{{ __('messages.transaction_time') }}:</strong> 2025-03-16 12:30 PM</p>
                <p><strong>{{ __('messages.order_commission') }}:</strong> 5.25 USDT</p>
            </div>
        </div>

        <button class="btn-submit">{{ __('messages.submit_order') }}</button>
    </div>
</div>

<script>
    let projectId = "{{ request()->get('id') }}";
    function fetchRandomProducts() {
        fetch(`/client/random-products?projectId=${projectId}`)
            .then(response => response.json())
            .then(data => {
                let container = document.getElementById("productContainer");
                const orderNumber = Math.floor(Math.random() * 9000000000) + 1000000000;
                const currentDate = new Date().toLocaleString();
                console.log(data);
                
                container.innerHTML = `
                    <div class="order-popup">
                        <button class="close-popup" onclick="closeOrderPopup()">✖</button>
                        <div class="order-header">
                            <p class="order-number">Order Nos: ${orderNumber}</p>
                        </div>
                        <div class="product-list">
                            ${data.products.map(product => `
                                <div class="product-item" data-product='${JSON.stringify(product)}'>
                                   <img src="{{ asset('${product.image}') }}" class="product-image" alt="${product.title}">
                                    <div class="product-details">
                                        <h3 class="product-title">${product.title}</h3>
                                        <div class="product-info">
                                            <span class="product-price">${product.price} USDT</span>
                                            <span class="product-quantity">x${product.quantity || 6}</span>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                        <div class="order-footer">
                            <div class="order-summary">
                                <span>Transaction time</span>
                                <span>${currentDate}</span>
                            </div>
                            <div class="order-summary">
                                <span>Order amount</span>
                                <span>${data.total_amount} USDT</span>
                            </div>
                            <div class="order-summary">
                                <span>Commissions</span>
                                <span>${data.commission} USDT</span>
                            </div>
                            <div class="order-summary">
                                <span>Expected income</span>
                                <span style="color: #E67E22;">${parseFloat(data.total_amount) + parseFloat(data.commission)} USDT</span>
                            </div>
                            <button class="submit-order-btn"
                                data-order='${orderNumber}'
                                data-total='${data.total_amount}'
                                data-commission='${data.commission}'
                                data-products='${JSON.stringify(data.products).replace(/'/g, "\\'").replace(/"/g, '&quot;')}'
                                onclick="handleOrder(this)">
                                {{ __('messages.submit_order') }}
                            </button>
                        </div>
                    </div>
                `;
            })
            .catch(error => console.error("{{ __('messages.error_fetching_products') }}:", error));
    }
    
    function openPopup() {
        // Get current project ID and user balance
        const projectId = {{ request()->get('id') }}; // Get the ID from the URL
        const userBalance = {{ Auth::user()->balance }}; // Get user balance
        const projectName = "{{ $name }}"; // Get project name
        const status =  {{ Auth::user()->status }};  // Get project name
        if (status === 0) {
        showErrorMessage("{{ __('messages.your_account_is_not_active_please_contact_support') }}");
        return;
    }
    if (status === 2) {
        showErrorMessage("{{ __('messages.please_complete_the_order_before_grabbing_another_one') }}");
        return;
    }
    if(userBalance==0){
        showErrorMessage("{{ __('messages.balance_low') }}");
    }
        // Define balance ranges for each project
        let allowedToOrder = false;
        let errorMessage = "";
        
        if (projectId == 1 && userBalance >=20 && userBalance <= 499) {
            allowedToOrder = true;
        } else if (projectId == 2 && userBalance > 499 && userBalance <= 899) {
            allowedToOrder = true;
        } else if (projectId == 3 && userBalance > 899) {
            allowedToOrder = true;
        }
        
        // Show popup or error based on balance check
        if (allowedToOrder) {
           // document.getElementById("orderPopup").style.display = "flex";
           fetchRandomProducts();
        } else {
            // Determine error message based on project ID
            if (projectId == 1) {
                errorMessage = projectName + " only allows users with balances 20 to 499 USDT";
            } else if (projectId == 2) {
                errorMessage = projectName + " only allows users with balances 499 to 899 USDT";
            } else if (projectId == 3) {
                errorMessage = projectName + " only allows users with balances 899 USDT and above";
            }
            
            // Show error message with overlay
            showErrorMessage(errorMessage);
        }
    }
    
    function closePopup() {
        document.getElementById("orderPopup").style.display = "none";
    }
    
    function showErrorMessage(message) {
        // Create error overlay if it doesn't exist
        let errorOverlay = document.getElementById("errorOverlay");
        if (!errorOverlay) {
            errorOverlay = document.createElement("div");
            errorOverlay.id = "errorOverlay";
            errorOverlay.className = "error-overlay";
            document.body.appendChild(errorOverlay);
            
            // Add styles for the overlay
            const style = document.createElement("style");
            style.innerHTML = `
                .error-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.2);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 9999;
                    transition: opacity 0.3s ease;
                }
                .error-message {
                    background: rgba(220, 53, 69, 0.9);
                    color: white;
                    padding: 20px;
                    border-radius: 8px;
                    text-align: center;
                    max-width: 80%;
                }
            `;
            document.head.appendChild(style);
        }
        
        // Add error message (without close button)
        errorOverlay.innerHTML = `
            <div class="error-message">
                <p>${message}</p>
            </div>
        `;
        
        // Display the overlay
        errorOverlay.style.display = "flex";
        errorOverlay.style.opacity = "1";
        
        // Automatically hide after 2 seconds
        setTimeout(function() {
            errorOverlay.style.opacity = "0";
            setTimeout(function() {
                errorOverlay.style.display = "none";
            }, 300); // Wait for fade-out transition
        }, 2000);
    }
    function successfullcloseOrderPopup() {
        const container = document.getElementById("productContainer");
        container.innerHTML = '';
    }
    function closeOrderPopup() {
        console.log('closeOrderPopup');
        const container = document.getElementById("productContainer");
        const orderNumber = container.querySelector('.order-number')?.textContent?.replace('Order Nos: ', '');
        
        if (orderNumber) {
            console.log('orderNumber'+orderNumber);
            // Get all order details
            const orderDetails = {
                order_number: orderNumber,
                total_amount: parseFloat(container.querySelector('.order-summary:nth-child(2) span:last-child')?.textContent?.replace(' USDT', '')),
                commission: parseFloat(container.querySelector('.order-summary:nth-child(3) span:last-child')?.textContent?.replace(' USDT', '')),
                expected_income: parseFloat(container.querySelector('.order-summary:nth-child(4) span:last-child')?.textContent?.replace(' USDT', '')),
                order_items: Array.from(container.querySelectorAll('.product-item')).map(item => {
                    const productData = JSON.parse(item.getAttribute('data-product') || '{}');
                    const imageSrc = item.querySelector('.product-image')?.src || '';
                    // Extract relative path from the full URL
                    const relativePath = imageSrc.split('/uploads/')[1] || '';
                    return {
                        product_id: String(productData.id || ''),
                        name: item.querySelector('.product-title')?.textContent || '',
                        price: parseFloat(item.querySelector('.product-price')?.textContent?.replace(' USDT', '') || 0),
                        quantity: parseInt(item.querySelector('.product-quantity')?.textContent?.replace('x', '') || 0),
                        image: relativePath ? 'uploads/' + relativePath : ''
                    };
                })
            };
            
            console.log('Order details:', orderDetails);
            
            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]')?.content;
            
            // Call the close-order endpoint
            fetch('/client/close-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(orderDetails)
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Failed to update order status:', data.message);
                }
                location.reload();
                console.log('data'+JSON.stringify(data));
            })
            .catch(error => {
                console.error('Error updating order status:', error);
            });
        }
        
        // Clear the container
        container.innerHTML = '';
    }
    function handleOrder(button) {
        const orderNumber = button.getAttribute("data-order");
        const totalAmount = button.getAttribute("data-total");
        const commission = button.getAttribute("data-commission");
        const products = JSON.parse(button.getAttribute("data-products").replace(/&quot;/g, '"')); 
        
        submitOrder(orderNumber, totalAmount, commission, products);
    }
    
    function submitOrder(orderNumber, totalAmount, commission, products) {   
        if (!products || !Array.isArray(products)) {
            console.error('Products data is invalid:', products);
            showErrorMessage('Invalid products data');
            return;
        }
        
        const formattedProducts = products.map(product => ({
            product_id: String(product.id || ''),
            quantity: parseInt(product.quantity || 6),
            name: product.title || '',
            image: product.image || '',
            price: parseFloat(product.price || 0)
        }));

        const orderData = {
            order_number: orderNumber,
            total_amount: parseFloat(totalAmount || 0),
            commission: parseFloat(commission || 0),
            expected_income: parseFloat(totalAmount || 0) + parseFloat(commission || 0),
            order_items: formattedProducts
        };
        
        // Debug log
        console.log('Submitting order with data:', orderData);

        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]')?.content;
        if (!token) {
            showErrorMessage('CSRF token not found');
            return;
        }

        // Submit the order
        fetch('/client/submit-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(orderData)
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) {
                if(response.status === 403 && data.need_balance) {
                    showErrorMessage(data.message);
                    return;
                }
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }
            return data;
        })
        .then(data => {
            if (data.success) {
                showSuccessMessage('Order submitted successfully');
                successfullcloseOrderPopup();
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                successfullcloseOrderPopup();
          
            }
        })
        .catch(error => {
            console.error('Error:', error);
            successfullcloseOrderPopup();
            if (error.message === 'insufficient_balance') {
                
                return;
            }
            showErrorMessage('Failed to submit order. Please try again.');
        });
    }

    // Add this function if you don't have it already
    function showSuccessMessage(message) {
        // You can implement this based on your UI needs
        alert(message); // Or use a better UI notification system
    }
</script>

@endsection
