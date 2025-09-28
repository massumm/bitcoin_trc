@extends('layouts.master')
@section('content')
    <!-- CSS -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/dist/jquery.fancybox.min.js') }}"></script> --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('assets/dist/jquery.fancybox.css') }}"> --}}
    <!-- JavaScript -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" /> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<div class="container-fluid px-4">

    <div class="card mt-4">
                   <div class="card-header">
                    @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                                  <h1 class="text-center">{{__('customerList')}}</h1>
                                  <a href="{{ url('admin/add-user') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> {{__('Add User')}}
                                  </a>
                                  <div class="table-responsive text-nowrap">
                                  <table id="myDataTable" class="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('userName')}}</th>
                                            <th>{{__('Password')}}</th>
                                            <th>{{__('Refer Code')}}</th>
                                            <th>{{__('Balance')}}</th>
                                            <th>{{__('Address')}}</th>
                                            <th>{{__('Client Role')}}</th>
                                            <th>{{__('status')}}</th>
                                            <th>{{__('Withdraw Status')}}</th>
                                            <th>{{__('action')}}</th>
                                            <th>User Action</th>
                                        </tr>
                                    </thead>
                                    <tbody  class="table-border-bottom-0">
                                        <!-- Table rows -->
                                        @foreach($UsersList->sortByDesc('id') as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->reveal_pass }}</td>
                                            <td>{{ $user->refer_code }}</td>
                                            <td>{{ $user->balance }}</td>
                                            <td>{{ $user->ip_address }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn {{ $user->demostatus == 0 ? 'btn-outline-primary' : ($user->demostatus == 2 ? 'btn-outline-info' : 'btn-outline-warning') }} dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        @if($user->demostatus == 0)
                                                            {{__('User 1')}}
                                                        @elseif($user->demostatus == 2)
                                                            {{__('User 2')}}
                                                        @elseif($user->demostatus == 3)
                                                            {{__('Kill')}}
                                                        @endif
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{url('admin/update-demo-status/'.$user->id.'/0')}}" class="dropdown-item">{{__('Demo 1')}}</a></li>
                                                        <li><a href="{{url('admin/update-demo-status/'.$user->id.'/2')}}" class="dropdown-item">{{__('Demo 2')}}</a></li>
                                                        <li><a href="{{url('admin/update-demo-status/'.$user->id.'/3')}}" class="dropdown-item">{{__('Kill')}}</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                @if($user->status > 0 && $user->status != 3)
                                                    <button
                                                    type="button"
                                                    class="btn btn-outline-success dropdown-toggle"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                  >
                                                  {{__('active')}}
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                    <li><a href="{{url('admin/update-user-status/'.$user->id)}}"  class="dropdown-item" href="javascript:void(0);">{{__('makeDeactive')}}</a></li>
                                                  </ul>
                                                    @else
                                                    <button
                                                    type="button"
                                                    class="btn btn-outline-danger dropdown-toggle"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                  >
                                                    deactive
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                    <li><a href="{{url('admin/update-user-status/'.$user->id)}}"  class="dropdown-item" href="javascript:void(0);">{{__('makeActive')}}</a></li>
                                                  </ul>
                                                    {{-- <span class="badge bg-label-danger me-1">  make deactive</span> --}}
                                                    @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn {{ $user->withdraw_status == 1 ? 'btn-outline-success' : ($user->withdraw_status == 2 ? 'btn-outline-warning' : 'btn-outline-danger') }} dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        @if($user->withdraw_status == 1)
                                                            {{__('Active')}}
                                                        @elseif($user->withdraw_status == 2)
                                                            {{__('Closed')}}
                                                        @else
                                                            {{__('Inactive')}}
                                                        @endif
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{url('admin/update-withdraw-status/'.$user->id.'/1')}}" class="dropdown-item">{{__('Make Active')}}</a></li>
                                                        <li><a href="{{url('admin/update-withdraw-status/'.$user->id.'/0')}}" class="dropdown-item">{{__('Make Inactive')}}</a></li>
                                                        <li><a href="{{url('admin/update-withdraw-status/'.$user->id.'/2')}}" class="dropdown-item">{{__('Close Withdraw')}}</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{url('admin/user-details/'.$user->id)}}" class="btn btn-info">{{__('Details')}}</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-edit-user" 
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-balance="{{ $user->balance }}"
                                                    data-password="{{ $user->reveal_pass }}"
                                                    >Edit</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                   </div>

    </div>

</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('admin/update-user') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="edit_user_id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_balance" class="form-label">Balance</label>
                        <input type="number" class="form-control" id="edit_balance" name="balance" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="edit_password" name="password" placeholder="Leave blank to keep current password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>


$(document).ready(function() {
            $('#myDataTable').DataTable({
                order: [0, 'dec'] // Sort by the first column (index 0) in descending order
            });
        });

    function confirmDelete() {
    return confirm('Are you sure you want to delete this user?');
}
document.addEventListener('DOMContentLoaded', function() {
    $(document).on('click', '.btn-edit-user', function() {
        const userId = $(this).data('id');
        const userName = $(this).data('name');
        const userBalance = $(this).data('balance');
        // Do not prefill password for security
        $('#edit_user_id').val(userId);
        $('#edit_name').val(userName);
        $('#edit_balance').val(userBalance);
        $('#edit_password').val('');
        $('#editUserModal').modal('show');
    });
});
</script>

@endsection
