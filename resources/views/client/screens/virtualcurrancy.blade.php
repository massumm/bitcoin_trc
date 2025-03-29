@extends('layouts.minimal2')

@section('title', __('messages.virtual_currency'))

@section('content')
    <form id="walletForm" onsubmit="submitWallet(event)">
        @csrf
        <div class="form-group">
            <label class="input-label">{{ __('messages.wallet_name') }}</label>
            <input type="text" name="wallet_name" class="form-control input-field" required 
                   placeholder="{{ __('messages.please_enter_the_wallet_name') }}">
        </div>

        <div class="form-group">
            <label class="input-label">{{ __('messages.virtual_currency_protocol') }}</label>
            <select name="currency_protocol" class="form-control input-field" required>
                <option selected disabled>{{ __('messages.please_select_a_virtual_currency_protocol') }}</option>
                <option value="USDT-TRC20">{{ __('messages.usdt_trc20') }}</option>
                <option value="USDT-ERC20">{{ __('messages.usdt_erc20') }}</option>
                <option value="BTC">{{ __('messages.btc') }}</option>
                <option value="ETH">{{ __('messages.eth') }}</option>
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
        <button type="button" class="btn btn-outline-primary cancel-btn">{{ __('messages.cancel') }}</button>
    </form>

    <script>
        function submitWallet(event) {
            event.preventDefault();
            
            const form = document.getElementById('walletForm');
            const formData = {
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
                    window.history.back();
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

    <style>
        .card {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: capitalize;
        }

        .input-label {
            font-size: 14px;
            color: #888;
            display: block;
            margin-bottom: 5px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #A0BFF8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn:disabled {
            background: #D0D7F5;
            cursor: not-allowed;
        }

        .cancel-btn {
            width: 100%;
            padding: 12px;
            background: white;
            color: #4A90E2;
            border: 1px solid #4A90E2;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background: #f0f0f0;
        }
    </style>
@endsection
