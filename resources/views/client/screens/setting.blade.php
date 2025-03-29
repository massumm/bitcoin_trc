@extends('layouts.minimal')

@section('title', __('messages.settings'))

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
    
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background: white;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        border-radius: 12px 12px 0 0;
        overflow-y: auto;
        padding: 20px;
        transition: transform 0.3s ease-in-out;
        transform: translateY(100%);
    }
    .modal.active {
        display: block;
        transform: translateY(0);
    }
    .modal-header {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
        background: white;
        color: black;
        padding: 10px;
    }
    .close-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        margin-left: auto;
    }
    .language-list {
        margin-top: 10px;
        max-height: 300px;
        overflow-y: auto;
    }
    .language-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }
    .language-item:hover {
        background: #f8f9fa;
    }
    .settings-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        cursor: pointer;
    }
    .settings-text {
        font-size: 16px;
        color: black;
    }
    .settings-arrow {
        font-size: 18px;
        color: gray;
    }
    .logout-btn {
        background: none;
        border: none;
        color: red;
        font-size: 16px;
        text-align: center;
        width: 100%;
        margin-top: 10px;
    }
</style>

<div class="settings-card" onclick="openLanguageModal()">
    <span class="settings-text">{{ __('messages.language_settings') }}</span>
    <span class="settings-arrow">&rsaquo;</span>
</div>

<!-- Logout Button -->
<div class="card p-3 mt-3">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
            {{ __('messages.logout') }}
        </button>
    </form>
</div>

<!-- Language Modal -->
<div id="languageModal" class="modal">
    <div class="modal-header">
        <span>{{ __('messages.select_language') }}</span>
        <button class="close-btn" onclick="closeLanguageModal()">&times;</button>
    </div>
    <div class="language-list">
        <div class="language-item" onclick="changeLanguage('en')">{{ __('messages.english') }}</div>
        <div class="language-item" onclick="changeLanguage('es')">{{ __('messages.spanish') }}</div>
        <div class="language-item" onclick="changeLanguage('ar')">{{ __('messages.arabic') }}</div>
        <div class="language-item" onclick="changeLanguage('us')">{{ __('messages.english') }}</div>
        <div class="language-item" onclick="changeLanguage('uk')">{{ __('messages.english') }}</div>
        <div class="language-item" onclick="changeLanguage('de')">{{ __('messages.german') }}</div>
        <div class="language-item" onclick="changeLanguage('ae')">{{ __('messages.arabic    ') }}</div>
        <div class="language-item" onclick="changeLanguage('cz')">{{ __('messages.czech') }}</div>
        <div class="language-item" onclick="changeLanguage('fr')">{{ __('messages.french') }}</div>
        <div class="language-item" onclick="changeLanguage('pt')">{{ __('messages.portuguese') }}</div>
        <div class="language-item" onclick="changeLanguage('it')">{{ __('messages.italian') }}</div>
        <div class="language-item" onclick="changeLanguage('tr')">{{ __('messages.turkish') }}</div>
        <div class="language-item" onclick="changeLanguage('ro')">{{ __('messages.romanian') }}</div>
        <div class="language-item" onclick="changeLanguage('dk')">{{ __('messages.danish') }}</div>
        <div class="language-item" onclick="changeLanguage('pl')">{{ __('messages.polish') }}</div>
        <div class="language-item" onclick="changeLanguage('se')">{{ __('messages.swedish') }}</div>
        <div class="language-item" onclick="changeLanguage('no')">{{ __('messages.norwegian') }}</div>
    </div>
</div>

<script>
    function openLanguageModal() {
        document.getElementById('languageModal').classList.add('active');
    }
    
    function closeLanguageModal() {
        document.getElementById('languageModal').classList.remove('active');
    }

    function changeLanguage(lang) {
        window.location.href = "{{ url('language') }}/" + lang;
    }
</script>
@endsection
