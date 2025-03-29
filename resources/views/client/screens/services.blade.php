@extends('layouts.client_master')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- First Section: Customer Service Info -->
    <div class="bg-rose text-black p-4 text-center rounded">
        <h4 class="mb-2">{{ __('messages.customer_service_center') }}</h4>
        <p class="mb-2">{{ __('messages.online_customer_service_time') }}</p>
        <p class="fw-bold"> (UK)</p>
        
    </div>

    <!-- Second Section: Clickable Cards -->
    <div class="mt-4">
        <div class="list-group">
            <a href="https://t.me/maasuumm" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-headset me-2"></i> {{ __('messages.online_customer_service') }}
                </div>
                <i class="fas fa-chevron-right text-muted"></i>
            </a>
            <a href="/client/help" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-question-circle me-2"></i> {{ __('messages.help') }}
                </div>
                <i class="fas fa-chevron-right text-muted"></i>
            </a>
        </div>
    </div>

</div>

<style>
.bg-rose {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
}

.list-group-item {
    padding: 15px;
    border: 1px solid #ddd;
    margin-bottom: 8px;
    border-radius: 8px !important;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.fas {
    color: #4169E1;
}
</style>

@endsection
