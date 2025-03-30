@extends('layouts.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h1>{{__('Add New User')}}</h1>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ url('admin/store-user') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{__('Username')}}</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{__('Password')}}</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="balance" class="form-label">{{__('Balance')}}</label>
                    <input type="number" class="form-control" id="balance" name="balance" value="0" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">{{__('Status')}}</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="1">{{__('Active')}}</option>
                        <option value="0">{{__('Inactive')}}</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{__('Add User')}}</button>
                <a href="{{ url('admin/view-userslist') }}" class="btn btn-secondary">{{__('Cancel')}}</a>
            </form>
        </div>
    </div>
</div>
@endsection 