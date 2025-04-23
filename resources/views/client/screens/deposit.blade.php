@extends('layouts.minimal2')

@section('title', __('messages.deposit'))

@section('content')
<style>
.deposit-container {
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

.section-title {
    color: #1F2937;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.payment-method-card, .protocol-card {
    background: white;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    padding: 1.25rem;
    width: 120px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.payment-method-card:hover, .protocol-card:hover {
    border-color: #3B82F6;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    transform: translateY(-2px);
}

.payment-method-card.selected, .protocol-card.selected {
    border-color: #3B82F6;
    background: #EBF5FF;
}

.payment-method-card img {
    width: 48px;
    height: 48px;
    margin-bottom: 0.5rem;
}

.card-label {
    color: #4B5563;
    font-size: 0.9rem;
    font-weight: 500;
    text-align: center;
}

.amount-input-container {
    background: white;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    padding: 1rem;
    margin-top: 1.5rem;
}

.amount-input {
    border: none;
    outline: none;
    width: 100%;
    font-size: 1.1rem;
    color: #1F2937;
    padding: 0.5rem;
    background: #F9FAFB;
    border-radius: 8px;
}

.amount-input:focus {
    background: #EBF5FF;
}

.currency-label {
    color: #6B7280;
    font-weight: 500;
    margin-right: 0.5rem;
}

.estimated-payment {
    background: #F9FAFB;
    border-radius: 12px;

    margin-top: 1.5rem;
}

.estimated-amount {
    color: #F59E0B;
    font-size: 1.25rem;
    font-weight: 600;
}

.rate-info {
    color: #6B7280;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.deposit-btn {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 1rem;
    font-weight: 500;
    width: 100%;
    margin-top: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.deposit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.deposit-btn:disabled {
    background: #E5E7EB;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.pending-deposit-container {
    display: none;
    background: white;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 1rem;
    text-align: center;
}

.pending-icon {
    color: #EF4444;
    font-size: 2rem;
    margin-bottom: 1rem;
}

.pending-title {
    color: #1F2937;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.address-box {
    background: #F3F4F6;
    border: 1px dashed #D1D5DB;
    border-radius: 8px;
    padding: 0.75rem;
    margin: 1rem 0;
    position: relative;
}

.address-text {
    font-family: monospace;
    color: #374151;
    font-size: 0.9rem;
    word-break: break-all;
}

.copy-btn {
    background: #3B82F6;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 0.5rem;
}

.copy-btn:hover {
    background: #2563EB;
}

.contact-support-btn {
    background: none;
    border: 1px solid #3B82F6;
    color: #3B82F6;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.contact-support-btn:hover {
    background: #EBF5FF;
}

.help-text {
    color: #6B7280;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .deposit-container {
        padding: 1rem;
    }
    
    .payment-method-card, .protocol-card {
        width: 100px;
    }
    
    .payment-method-card img {
        width: 40px;
        height: 40px;
    }
}
</style>

<div class="deposit-container">
    <!-- Pending Deposit Container -->
    <div id="pendingDepositContainer" class="pending-deposit-container">
        <i class="fas fa-exclamation-circle pending-icon"></i>
        <div class="pending-title">{{ __('messages.unpaid_order') }}</div>
        <div class="address-box">
            <div class="address-text" id="pendingAddress"></div>
            <button class="copy-btn" onclick="copyAddress()">
                <i class="fas fa-copy me-1"></i> {{ __('messages.copy') }}
            </button>
        </div>
        <button class="contact-support-btn" onclick="contactSupport()">
            {{ __('messages.contact_customer_service') }}
        </button>
        <div class="help-text">
            {{ __('messages.click_to_copy_address_help') }}
        </div>
    </div>

    <!-- Regular Deposit Form -->
    <div id="regularDepositContainer">
        <h2 class="section-title mt-4">{{ __('messages.select_protocol') }}</h2>
        <div class="protocol-card selected">
            <div class="d-flex flex-column align-items-center">
                <span class="card-label">{{ __('messages.trc20') }}</span>
            </div>
        </div>

        <!-- Deposit Amount -->
        <div class="amount-input-container">
            <h2 class="section-title mb-3">{{ __('messages.deposit_amount') }}</h2>
            <div class="d-flex align-items-center">
                <span class="currency-label">{{ __('messages.usdt') }}</span>
                <input type="number" 
                       class="amount-input" 
                       id="depositAmount" 
                       min="10" 
                       placeholder="{{ __('messages.deposit_amount_must_be_greater_than_10_usdt') }}">
            </div>
        </div>

        <!-- Estimated Payment -->
        <div class="estimated-payment">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-secondary">{{ __('messages.estimated_payment') }}:</span>
                <div>
                    <span class="estimated-amount" id="estimatedPayment">0.00</span>
                    <span class="ms-1 text-secondary">{{ __('messages.usdt') }}</span>
                </div>
            </div>
            <div class="rate-info">
                <p class="mb-1">{{ __('messages.reference_rate') }}: 1{{ __('messages.usdt') }}=1{{ __('messages.usdt') }}</p>
                <p class="mb-0 text-muted small">{{ __('messages.payment_amount_and_exchange_rate_are_subject_to_actual_payment') }}</p>
            </div>
        </div>

        <!-- Deposit Button -->
        <button id="depositNow" class="deposit-btn">
            <i class="fas fa-arrow-right me-2"></i>
            {{ __('messages.deposit_now') }}
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    if (!localStorage.getItem('lastCleanScreen')) {
    localStorage.setItem('lastCleanScreen', window.location.href);
}
    const depositAmount = document.getElementById('depositAmount');
    const estimatedPayment = document.getElementById('estimatedPayment');
    const depositBtn = document.getElementById('depositNow');
    const pendingContainer = document.getElementById('pendingDepositContainer');
    const regularContainer = document.getElementById('regularDepositContainer');

    // Check for pending deposits when page loads
    checkPendingDeposits();

    function checkPendingDeposits() {
        fetch('/client/check-deposit-addresss')
            .then(response => response.json())
            .then(data => {
                console.log(data)
                if (data.success) {
                    if (data.hasPendingDeposit) {
                        // Show pending deposit container
                        pendingContainer.style.display = 'block';
                        regularContainer.style.display = 'none';
                        document.getElementById('pendingAddress').textContent = data.pendingDeposit.address;
                    } else if (data.deactiveuser) {
                        // Disable deposit button and show alert for deactivated user
                        depositBtn.style.display = 'none';
                        depositBtn.innerHTML = '<i class="fas fa-ban me-2"></i>{{ __('messages.user_not_active') }}';
                        showToast('{{ __('messages.user_not_active_please_contact_support') }}', 'error');
                    } else {
                        // Show regular deposit form
                        pendingContainer.style.display = 'none';
                        regularContainer.style.display = 'block';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error toast
                //showToast('Error checking deposit status', 'error');
            });
    }

    // Define copyAddress function
    window.copyAddress = function() {
        const address = document.getElementById('pendingAddress').textContent;
        navigator.clipboard.writeText(address).then(() => {
            showToast('{{ __('messages.address_copied_to_clipboard') }}', 'success');
        }).catch(() => {
            showToast('{{ __('messages.failed_to_copy_address') }}', 'error');
        });
    };

    // Define contactSupport function
    window.contactSupport = function() {
        window.location.href = 'https://t.me/customerservice10002';
    };

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
        toast.style.zIndex = '1050';
        toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    depositAmount.addEventListener('input', function() {
        const amount = this.value || '0.00';
        estimatedPayment.textContent = parseFloat(amount).toFixed(2);
        
        // Enable/disable button based on amount
        if (parseFloat(amount) >= 10) {
            depositBtn.removeAttribute('disabled');
        } else {
            depositBtn.setAttribute('disabled', 'disabled');
        }
    });
if (!localStorage.getItem('lastCleanScreen')) {
    localStorage.setItem('lastCleanScreen', window.location.href);
}
    depositBtn.addEventListener('click', function() {
        const amount = depositAmount.value;
        if (amount && parseFloat(amount) >= 10) {
            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>{{ __('messages.processing') }}...';
            this.disabled = true;
            
            window.location.href = '/client/mine/virtualdetail?amount=' + amount;
        } else {
            // Show error toast
            const toast = document.createElement('div');
            toast.className = 'alert alert-danger position-fixed top-0 end-0 m-3';
            toast.style.zIndex = '1050';
            toast.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>{{ __('messages.please_enter_an_amount_greater_than_10_usdt') }}';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    });
});
</script>
@endsection
