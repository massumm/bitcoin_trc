@extends('layouts.minimal2')

@section('title', 'Virtual Currency')

@section('content')


  
            <div class="form-group">
                <label class="input-label">Wallet name</label>
                <input type="text" class="form-control input-field" placeholder="Please enter the wallet name">
            </div>

            <div class="form-group">
                <label class="input-label">Virtual Currency Protocol</label>
                <select class="form-control input-field">
                    <option selected disabled>Please select a virtual currency protocol</option>
                    <option>USDT (TRC20)</option>
                    <option>USDT (ERC20)</option>
                    <option>BTC</option>
                    <option>ETH</option>
                </select>
            </div>

            <div class="form-group">
                <label class="input-label">Wallet address</label>
                <input type="text" class="form-control input-field" placeholder="Please enter the e-wallet address">
            </div>

            <div class="form-group">
                <label class="input-label">Names</label>
                <input type="text" class="form-control input-field" placeholder="Names">
            </div>

            <button class="btn btn-primary submit-btn">OK</button>
            <button class="btn btn-outline-primary cancel-btn">Cancel</button>
        </div>
   
</div>

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
