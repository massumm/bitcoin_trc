@extends('layouts.minimal2')

@section('title', __('messages.virtual_currency'))

@section('content')
    <form id="walletForm" onsubmit="submitWallet(event)">
        @csrf

        {{-- Step 1: Password --}}
        <div id="passwordSection">
            <div class="form-group">
                <label class="input-label">{{ __('messages.password') }}</label>
                <input type="password" name="password" class="form-control input-field" required
                       placeholder="{{ __('messages.enter_your_password') }}">
            </div>
            <button type="button" class="btn btn-primary submit-btn" onclick="showWalletFields()">
                {{ __('messages.submit') }}
            </button>
        </div>

        {{-- Step 2: Full Wallet Form --}}
        <div id="walletFields" style="display: none;">
            <div class="form-group">
                <label class="input-label">{{ __('messages.wallet_name') }}</label>
                <input type="text" name="wallet_name" class="form-control input-field" required 
                       placeholder="{{ __('messages.please_enter_the_wallet_name') }}">
            </div>

            <div class="form-group">
                <label class="input-label">{{ __('messages.virtual_currency_protocol') }}</label>
                <select name="currency_protocol" class="form-control input-field" required>
                    <option selected disabled>{{ __('messages.please_select_a_virtual_currency_protocol') }}</option>
                    <option value="USDT-TRC20">TRC20</option>
                    <!-- <option value="USDT-ERC20">{{ __('messages.usdt_erc20') }}</option>
                    <option value="BTC">{{ __('messages.btc') }}</option>
                    <option value="ETH">{{ __('messages.eth') }}</option> -->
                </select>
            </div>

            <div class="form-group">
                <label class="input-label">{{ __('messages.wallet_address') }}</label>
                <input type="text" name="wallet_address" class="form-control input-field" required
                       placeholder="{{ __('messages.please_enter_the_e_wallet_address') }}">
            </div>

            <div class="form-group">
                <label class="input-label">{{ __('messages.names') }}</label>
                <input type="text" name="names" class="form-control input-field" required
                       placeholder="{{ __('messages.please_enter_the_names') }}">
            </div>

            <button type="submit" class="btn btn-primary submit-btn">{{ __('messages.ok') }}</button>
            <button type="button" class="btn btn-outline-primary cancel-btn" onclick="window.history.back()">
                {{ __('messages.cancel') }}
            </button>
        </div>
    </form>

    <script>
        function showWalletFields() {
            const password = document.querySelector('input[name="password"]').value;
            if (!password) {
                alert("{{ __('messages.enter_your_password') }}");
                return;
            }
            document.getElementById('passwordSection').style.display = 'none';
            document.getElementById('walletFields').style.display = 'block';
        }

        function submitWallet(event) {
            event.preventDefault();
            
            const form = document.getElementById('walletForm');
            console.log(form.password.value);
            const formData = {
                password: form.password.value,
                wallet_name: form.wallet_name.value,
                currency_protocol: form.currency_protocol.value,
                wallet_address: form.wallet_address.value,
                names: form.names.value
            };

            fetch('/client/mine/wallet', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Wallet added successfully:', data);
                    window.location.href = '/client/mine'; 
                    // window.location.reload();
                } else {
                    alert(data.message || 'Failed to add wallet');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }
    </script>
@endsection
