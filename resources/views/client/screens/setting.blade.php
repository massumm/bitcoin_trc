@extends('layouts.minimal')

@section('title', 'Setting')

@section('content')
<style>
    .logout-btn {
        background: #dc3545;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 16px;
        width: 100%;
        margin-top: 10px;
        transition: background 0.3s ease;
    }

    .logout-btn:hover {
        background: #c82333;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
</style>

<div class="card p-3">
    <form method="POST" >
        @csrf
        <button   href="{{ route('logout') }}" type="submit" class="logout-btn">
            Logout
        </button>
    </form>
</div>

@endsection
