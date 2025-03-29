@extends('layouts.minimal2')

@section('title', __('messages.deposit_records'))

@section('content')
<style>
    .record-item {
        background: white;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .record-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .record-type {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .record-status {
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 12px;
    }
    .status-failed {
        color: #ff4d4f;
    }
    .status-success {
        color: #52c41a;
    }
    .record-time {
        color: #8c8c8c;
        font-size: 12px;
    }
    .record-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .record-id {
        color: #8c8c8c;
        font-size: 14px;
    }
    .record-amount {
        font-size: 16px;
        font-weight: 500;
        text-align: right;
    }
</style>

<div class="container px-3">
    @foreach($deposits as $deposit)
        <div class="record-item">
            <div class="record-header">
                <div class="record-type">
                    <span>{{ __('messages.deposit') }}</span>
                    <span class="record-status {{ $deposit->status == 0 ? 'status-failed' : 'status-success' }}">
                        {{ $deposit->status}}
                    </span>
                </div>
                <div class="record-time">
                    {{ \Carbon\Carbon::parse($deposit->date)->format('Y-m-d H:i:s') }}
                </div>
            </div>
            <div class="record-info">
                <div class="record-id">
                    {{ $deposit->trxid }}
                </div>
                <div class="record-amount">
                    {{ number_format($deposit->amount, 2) }} {{ __('messages.usdt') }}
                </div>
            </div>
        </div>
    @endforeach

    @if($deposits->isEmpty())
        <div class="text-center py-5">
            <p>{{ __('messages.no_deposit_records_found') }}</p>
        </div>
    @endif
</div>
@endsection
