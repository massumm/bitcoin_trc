@extends('layouts.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h1 class="text-center display-4 mb-4">{{ $user->name }}</h1>
            <h2 class="text-center mb-4">Balance: {{ $user->balance }}</h2>
            
            <div class="row">
                @for($i = 1; $i <= 25; $i++)
                    <div class="col-md-4 mb-3">
                        <button 
                            class="btn btn-lg w-100 {{ $i <= $user->today_task ? 'btn-success' : 'btn-secondary' }}"
                            onclick="showProductModal({{ $i }})"
                        >
                            Task {{ $i }}
                        </button>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    <input type="number" 
                                           class="form-control quantity-input" 
                                           data-price="{{ $product->price }}"
                                           value="1" 
                                           min="1" 
                                           max="{{ $product->quantity }}"
                                           onchange="calculateSubtotal(this)">
                                </td>
                                <td class="subtotal">${{ number_format($product->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                <td id="totalAmount">$0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitOrder()">Submit Order</button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-lg {
        font-size: 1.2rem;
        padding: 1rem;
        margin: 0.5rem;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .quantity-input {
        width: 80px;
    }
</style>

<script>
let productModal;

document.addEventListener('DOMContentLoaded', function() {
    productModal = new bootstrap.Modal(document.getElementById('productModal'));
    calculateTotal();
});

function showProductModal(taskNumber) {
    productModal.show();
}

function calculateSubtotal(input) {
    const price = parseFloat(input.dataset.price);
    const quantity = parseInt(input.value);
    const subtotal = price * quantity;
    input.closest('tr').querySelector('.subtotal').textContent = '$' + subtotal.toFixed(2);
    calculateTotal();
}

function calculateTotal() {
    const subtotals = document.querySelectorAll('.subtotal');
    let total = 0;
    subtotals.forEach(subtotal => {
        total += parseFloat(subtotal.textContent.replace('$', ''));
    });
    document.getElementById('totalAmount').textContent = '$' + total.toFixed(2);
}

function submitOrder() {
    const orderData = {
        products: Array.from(document.querySelectorAll('.quantity-input')).map(input => ({
            product_id: input.closest('tr').querySelector('td:first-child').textContent,
            quantity: input.value,
            price: input.dataset.price,
            title: input.closest('tr').querySelector('td:nth-child(2)').textContent
        })),
        total: document.getElementById('totalAmount').textContent,
        user_id: '{{ $user->id }}'
    };
    
    fetch('/admin/store-combo', {
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
            productModal.hide();
        } else {
            alert('Failed to submit order: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting the order.');
    });
}
</script>

@endsection 