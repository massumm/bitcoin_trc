@extends('layouts.minimal')

@section('title', 'Profile')

@section('content')

<style>
    .profile-card {
        background: white;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .profile-text {
        color: #333;
        font-size: 16px;
    }
    .profile-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
    }
    #imageUpload {
        display: none;
    }
</style>

<div class="container px-3">
    <div class="profile-card">
        <span class="profile-text">{{ __('messages.personal_avatar') }}</span>
        <label for="imageUpload">
            <img src="{{ asset('assets/img/profile.jpg') }}" alt="Avatar" class="profile-avatar" id="profileImage">
        </label>
        <input type="file" id="imageUpload" accept="image/*">
    </div>
</div>

<script>
document.getElementById('imageUpload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Create FormData
        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');

        // Upload image
        fetch('/client/upload-profile-image', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update image preview
                document.getElementById('profileImage').src = data.image_url;
                alert('Profile image updated successfully');
            } else {
                alert(data.message || 'Failed to upload image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to upload image');
        });
    }
});
</script>

@endsection
