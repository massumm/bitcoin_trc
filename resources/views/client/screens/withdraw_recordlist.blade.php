@extends('layouts.minimal2')

@section('title', __('messages.withdraw_records'))

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
    .status-pending {
        color: #faad14;
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
    @foreach($withdraws as $withdraw)
        <div class="record-item">
            <div class="record-header">
                <div class="record-type">
                    <span>{{ __('messages.withdraw') }}</span>
                    <span class="record-status {{ strtolower($withdraw->status) == 'failed' ? 'status-failed' : (strtolower($withdraw->status) == 'success' ? 'status-success' : 'status-pending') }}">
                        {{ $withdraw->status }}
                    </span>
                </div>
                <div class="record-time">
                    {{ $withdraw->date}}
                </div>
            </div>
            <div class="record-info">
                <div class="record-id">
                    {{ $withdraw->address }}
                </div>
                <div class="record-amount">
                    {{ number_format($withdraw->amount, 2) }} {{ __('messages.usdt') }}
                </div>
            </div>
        </div>
    @endforeach

    @if($withdraws->isEmpty())
        <div class="text-center py-5">
            <p>{{ __('messages.no_withdraw_records_found') }}</p>
        </div>
    @endif
</div>
@endsection
