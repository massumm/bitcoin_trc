@extends('layouts.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-primary" onclick="showEditModal()">
                    <i class="fas fa-edit"></i> Edit User
                </button>
            </div>
            <h1 class="text-center display-4 mb-4">{{ $user->name }}</h1>
            <h2 class="text-center mb-4">Balance: {{ $user->balance }}</h2>
            
            <div class="row">
                @php
                    $comboTasks = [];
                    if($user->demostatus == 0) {
                        $comboTasks = [20];
                    } elseif($user->demostatus == 1) {
                        $comboTasks = [7, 17, 24];
                    } elseif($user->demostatus == 2) {
                        $comboTasks = [7, 17, 24];
                    } elseif($user->demostatus == 3) {
                        $comboTasks = [5, 10, 18, 23, 25];
                    }
                @endphp
                @for($i = 1; $i <= 25; $i++)
                    <div class="col-md-4 mb-3">
                        <button 
                            class="btn btn-lg w-100 {{ 
                                $i <= $user->today_task 
                                    ? (in_array($i, $comboTasks) ? 'btn-warning' : 'btn-success') 
                                    : 'btn-secondary' 
                            }}"
                            onclick="{{ in_array($i, $comboTasks) ? 'showComboModal('.$i.')' : 'showProductModal('.$i.')' }}"
                        >
                            Task {{ $i }}
                            @if(in_array($i, $comboTasks))
                                <i class="fas fa-star ms-2"></i>
                            @endif
                        </button>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('admin/update-user') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="balance" class="form-label">Balance</label>
                        <input type="number" class="form-control" id="balance" name="balance" value="{{ $user->balance }}" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
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
                                <th>Image</th>
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
                                <td>
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
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
        <td colspan="4" class="text-end"><strong>Commission (%):</strong></td>
        <td>
            <input type="number" id="commissionInput" class="form-control" min="0" step="0.01" value="0" onchange="calculateTotal()">
        </td>
    </tr>
    <tr>
        <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
        <td id="totalAmount">$0.00</td>
    </tr>
    <tr>
        <td colspan="4" class="text-end"><strong>Final Total (with Commission):</strong></td>
        <td id="finalTotalAmount">$0.00</td>
    </tr>
    <tr>
        <td colspan="4" class="text-end"><strong>combo money:</strong></td>
        <td id="combomoneyTotalAmount">$0.00</td>
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

<!-- Combo Modal -->
<div class="modal fade" id="comboModal" tabindex="-1" aria-labelledby="comboModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comboModalLabel">Combo Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product ID</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="comboProductsBody">
                            <!-- Combo products will be loaded here -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Commission (%):</strong></td>
                                <td>
                                    <input type="number" id="comboCommissionInput" class="form-control" min="0" step="0.01" value="0" onchange="calculateComboTotal()">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                                <td id="comboTotalAmount">$0.00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Final Total (with Commission):</strong></td>
                                <td id="comboFinalTotalAmount">$0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitComboOrder()">Submit Combo Order</button>
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
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000;
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
let comboModal;
let editUserModal;
let currentTaskNumber = 0;

document.addEventListener('DOMContentLoaded', function() {
    productModal = new bootstrap.Modal(document.getElementById('productModal'));
    comboModal = new bootstrap.Modal(document.getElementById('comboModal'));
    editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    calculateTotal();
});

function showProductModal(taskNumber) {
    currentTaskNumber = taskNumber;
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

    const commissionPercent = parseFloat(document.getElementById('commissionInput').value || 0);
    const commissionAmount = total * (commissionPercent / 100);
    const finalTotal = total + commissionAmount;
    const userBalance = parseFloat('{{ $user->balance }}');
    const combomoneyTotal = total -userBalance  ;

    document.getElementById('finalTotalAmount').textContent = '$' + finalTotal.toFixed(2);
    document.getElementById('combomoneyTotalAmount').textContent = '$' + combomoneyTotal.toFixed(2);
}

function showEditModal() {
    editUserModal.show();
}

function showComboModal(taskNumber) {
    currentTaskNumber = taskNumber;
    const user_id = '{{ $user->id }}';

    fetch(`/admin/get-combo-products/${taskNumber}/${user_id}`, {
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const tbody = document.getElementById('comboProductsBody');
            tbody.innerHTML = data.products.map(product => `
                <tr>
                    <td>
                        <img src="{{ asset('') }}${product.image}" alt="${product.title}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>${product.product_id}</td>
                    <td>${product.title}</td>
                    <td>$${product.price.toFixed(2)}</td>
                    <td>
                        <input type="number" 
                               class="form-control quantity-input" 
                               data-price="${product.price}"
                               value="${product.quantity}" 
                               min="1" 
                               onchange="calculateComboTotal()">
                    </td>
                    <td class="subtotal">$${(product.price * product.quantity).toFixed(2)}</td>
                </tr>
            `).join('');

            // ✅ Set commission input value using first product's commission
            if (data.products.length > 0) {
                const commission = parseFloat(data.commission) || 0;
                document.getElementById('comboCommissionInput').value = commission;
            }

            calculateComboTotal();
            comboModal.show();
        } else {
            alert('Failed to load combo products: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while loading combo products.');
    });
}

function calculateComboTotal() {
    console.log('calculateComboTotal');
    const rows = document.querySelectorAll('#comboProductsBody tr');
    let subtotal = 0;

    rows.forEach(row => {
        const quantityInput = row.querySelector('.quantity-input');
        const price = parseFloat(quantityInput.dataset.price);
        const quantity = parseInt(quantityInput.value) || 0;

        const itemSubtotal = price * quantity;
        row.querySelector('.subtotal').textContent = `$${itemSubtotal.toFixed(2)}`;

        subtotal += itemSubtotal;
    });


    // Update subtotal
    const subtotalElement = document.getElementById('comboTotalAmount');
    if (subtotalElement) {
        subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
    }

    // Get commission percentage from input
    const commissionInput = document.getElementById('comboCommissionInput');
    const commissionPercent = parseFloat(commissionInput.value) || 0;

    // Calculate final total
    const commissionAmount = subtotal * (commissionPercent / 100);
    const finalTotal = subtotal + commissionAmount;

    // Update final total
    const finalTotalElement = document.getElementById('comboFinalTotalAmount');
    if (finalTotalElement) {
        finalTotalElement.textContent = `$${finalTotal.toFixed(2)}`;
    }
}




function submitComboOrder() {
    const total = parseFloat(document.getElementById('comboTotalAmount').textContent.replace('$', ''));
    const commissionPercent = parseFloat(document.getElementById('comboCommissionInput').value || 0);
    const commissionAmount = total * (commissionPercent / 100);
    const finalTotal = total + commissionAmount;

    const orderData = {
        products: Array.from(document.querySelectorAll('#comboProductsBody .quantity-input')).map(input => {
            const row = input.closest('tr');
            return {
                product_id: row.querySelector('td:nth-child(2)').textContent,
                quantity: input.value,
                price: input.dataset.price,
                title: row.querySelector('td:nth-child(3)').textContent,
                image: row.querySelector('img').src.split('/').pop()
            };
        }),
        subtotal: total.toFixed(2),
        commission_percent: commissionPercent.toFixed(2),
        commission_amount: commissionAmount.toFixed(2),
        total: finalTotal.toFixed(2),
        user_id: '{{ $user->id }}',
        task_number: currentTaskNumber
    };

    fetch('{{ route("admin.store-combo") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Combo order submitted successfully!');
            comboModal.hide();
            location.reload();
        } else {
            alert('Failed to submit combo order: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting the combo order.');
    });
}

function submitOrder() {
    const total = parseFloat(document.getElementById('totalAmount').textContent.replace('$', ''));
    const commissionPercent = parseFloat(document.getElementById('commissionInput').value || 0);
    const commissionAmount = total * (commissionPercent / 100);
    const finalTotal = total + commissionAmount;

    const orderData = {
        products: Array.from(document.querySelectorAll('.quantity-input')).map(input => {
            const row = input.closest('tr');
            return {
                product_id: row.querySelector('td:nth-child(2)').textContent,
                quantity: input.value,
                price: input.dataset.price,
                title: row.querySelector('td:nth-child(3)').textContent,
                image: row.querySelector('img').src.split('/').pop() // Get just the filename
            };
        }),
        subtotal: total.toFixed(2),
        commission_percent: commissionPercent.toFixed(2),
        commission_amount: commissionAmount.toFixed(2),
        total: finalTotal.toFixed(2),
        user_id: '{{ $user->id }}',
        task_number: currentTaskNumber
    };
    console.log(orderData);
    
    fetch('{{ route("admin.store-combo") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Order submitted successfully!');
            productModal.hide();
            location.reload(); // Reload the page to update the task buttons
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