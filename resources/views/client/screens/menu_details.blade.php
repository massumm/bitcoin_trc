@extends('layouts.minimal')

@section('title', $name ?? 'Project Details')

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
        top: 40px;
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
        margin: 40px auto 20px auto;
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
        <p>Account Balance:</p>
        <h2><span class="text-success">{{ Auth::user()->balance }}</span> USDT</h2>
    </div>

    <!-- Centered Card -->
    <div class="info-card">
        <div class="row">
            <div class="col-6">
                <p>Today's Times</p>
                <h5>{{ Auth::user()->today_task }}</h5>
            </div>
            <div class="col-6">
                <p>Today's Commission</p>
                <h5><span class="text-success">{{ Auth::user()->min_earn }}</span> USDT</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p>Cash gap between tasks</p>
                <h5>0 USDT</h5>
            </div>
            <div class="col-6">
                <p>Yesterday's Buy Commission</p>
                <h5>0 USDT</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p>Yesterday's Team Commission</p>
                <h5>0 USDT</h5>
            </div>
            <div class="col-6">
                <p>Money Frozen in Accounts</p>
                <h5>0 USDT</h5>
            </div>
        </div>
    </div>

    <!-- Grab Order Button -->
    <button class="btn btn-primary" onclick="openPopup()">Grab the order immediately</button>

    <!-- Hint Section -->
    <div class="hint-box">
        <h6>Hint:</h6>
        <p>1: 5% of the amount of completed transactions earned.</p>
        <p>2: The system sends tasks randomly. Complete them as soon as possible after matching them, to avoid hanging all the time.</p>
    </div>
</div>

<!-- Order Popup -->
<div class="popup-bg" id="orderPopup">
    <div class="popup-card">
        <span class="close-btn" onclick="closePopup()">✖</span>
        <h4>Order Details</h4>

        <div class="order-details">
            <p><strong>Order No:</strong> 12345678</p>
            <div class="mt-3">
                <p><strong>Transaction Time:</strong> 2025-03-16 12:30 PM</p>
                <p><strong>Order Commission:</strong> 5.25 USDT</p>
            </div>
        </div>

        <button class="btn-submit">Submit Order</button>
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
                                <div class="product-item">
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
    Submit order
</button>
                        </div>
                    </div>
                `;
            })
            .catch(error => console.error("Error fetching products:", error));
    }
    
    function openPopup() {
        // Get current project ID and user balance
        const projectId = {{ request()->get('id') }}; // Get the ID from the URL
        const userBalance = {{ Auth::user()->balance }}; // Get user balance
        const projectName = "{{ $name }}"; // Get project name
        const status =  {{ Auth::user()->status }};  // Get project name
        if (status === 0) {
        showErrorMessage("Your account is not active. Please contact support.");
        return;
    }
    if (status === 2) {
        showErrorMessage("Please complete the order before grabbing another one");
        return;
    }
        // Define balance ranges for each project
        let allowedToOrder = false;
        let errorMessage = "";
        
        if (projectId == 1 && userBalance >= 0 && userBalance <= 200) {
            allowedToOrder = true;
        } else if (projectId == 2 && userBalance > 200 && userBalance <= 300) {
            allowedToOrder = true;
        } else if (projectId == 3 && userBalance > 300 && userBalance <= 400) {
            allowedToOrder = true;
        }
        
        // Show popup or error based on balance check
        if (allowedToOrder) {
           // document.getElementById("orderPopup").style.display = "flex";
           fetchRandomProducts();
        } else {
            // Determine error message based on project ID
            if (projectId == 1) {
                errorMessage = projectName + " only allows users with balances 0 to 200 USDT";
            } else if (projectId == 2) {
                errorMessage = projectName + " only allows users with balances 201 to 300 USDT";
            } else if (projectId == 3) {
                errorMessage = projectName + " only allows users with balances 301 to 400 USDT";
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

    function closeOrderPopup() {
        const container = document.getElementById("productContainer");
        container.innerHTML = '';
    }
    function handleOrder(button) {
    const orderNumber = button.getAttribute("data-order");
    const totalAmount = button.getAttribute("data-total");
    const commission = button.getAttribute("data-commission");
    const products = JSON.parse(button.getAttribute("data-products")); 
    
  

    submitOrder(orderNumber, totalAmount, commission, products);
}
     function submitOrder(orderNumber, totalAmount, commission, products) {   
        
        // First, let's validate that we have all required data
        if (!products || !Array.isArray(products)) {
            console.error('Products data is invalid:', products);
            showErrorMessage('Invalid products data');
            return;
        }

        // Format the data properly
        const formattedProducts = products.map(product => ({
            id: product.id,
            product_id: product.id,
            quantity: product.quantity,
            name: product.title,
            image: product.image,
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
                if(response.status === 403 && data.need_balance)
                {
                    showErrorMessage(data.message);
                    return Promise.reject(new Error('insufficient_balance'));
                }
                if (response.status === 403 && data.need_balance) {
                    // Handle insufficient balance case
                    showErrorMessage(data.message);
                    // Optionally redirect to top-up page or show top-up modal
                    return Promise.reject(new Error('insufficient_balance'));
                }
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }
            return data;
        })
        .then(data => {
            if (data.success) {
                showSuccessMessage('Order submitted successfully!');
                closeOrderPopup();
                // Optionally refresh the page or update UI
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                throw new Error(data.message || 'Failed to submit order');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.message === 'insufficient_balance') {
                // Already handled by the 403 case
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
