@extends('layouts.client_master')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- First Section: Customer Service Info -->
    <div class="bg-rose text-black p-4 text-center rounded">
        <h4 class="mb-2">Customer Service Center</h4>
        <p class="mb-2">Online customer service time</p>
        <p class="fw-bold">07:00 - 23:00 (UK)</p>
        
    </div>

    <!-- Second Section: Clickable Cards -->
    <div class="mt-4">
        <div class="list-group">
            <a class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-headset me-2"></i> Online Customer Service
            </a>
            <a  class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-question-circle me-2"></i> Help
            </a>
        </div>
    </div>

</div>

@endsection
