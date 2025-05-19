@extends('layouts.minimal2')

@section('title', __('messages.invite_friends'))

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
    <!-- Header -->
    <!-- Referral Code -->
    <p class="text-muted">{{ __('messages.my_invitation_code') }}</p>
    <h1 class="fw-bold text-dark" id="referralCode">{{ Auth::user()->refer_code }}</h1>

    <!-- QR Code -->
    <div class="mb-3 d-flex justify-content-center">
        <img id="qrCode" src="" alt="QR Code" class="img-fluid" style="max-width: 180px;">
    </div>
    <p class="text-danger small">{{ __('messages.long_press_to_save_the_qr_code') }}</p>

    <!-- Share Link -->
    <div class="card p-3 shadow-sm w-100" style="max-width: 350px;">
        <div class="d-flex justify-content-between align-items-center">
            <p class="text-muted m-0">{{ __('messages.share_link') }}</p>
            <button class="btn btn-link text-danger p-0" onclick="copyLink()">{{ __('messages.copy') }}</button>
        </div>
        <input type="text" id="shareLink" class="form-control mt-2" value="{{ url('/register?code=') . Auth::user()->refer_code }}" readonly>
    </div>
</div>

<style>
.container {
    max-width: 400px;
}
.card {
    border-radius: 8px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const referralCode = document.getElementById('referralCode').textContent;
    const qrCodeImg = document.getElementById('qrCode');
    
    // Generate QR Code URL
    const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=${encodeURIComponent("{{ url('/register?code=') }}" + referralCode)}`;
    
    qrCodeImg.src = qrCodeUrl;

    // Copy Link Function
    window.copyLink = function() {
        const shareLink = document.getElementById('shareLink');
        shareLink.select();
        document.execCommand('copy');
        showErrorMessage('{{ __('messages.link_copied_to_clipboard') }}');
  
    }
});
    function showErrorMessage(message) {
        const toast = document.createElement('div');
        toast.className = 'alert alert-danger position-fixed start-50 top-50 translate-middle';
        toast.style.zIndex = '1050';
        toast.style.minWidth = '300px';
        toast.style.maxWidth = '80%';
        toast.style.width = 'auto';
  
        toast.style.textAlign = 'center';
        toast.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>
@endsection
