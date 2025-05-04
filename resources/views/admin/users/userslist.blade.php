@extends('layouts.master')
@section('content')

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
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                   </div>



                 <script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this user?');
}
</script>

    </div>

</div>
 @endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            pageLength: 100,
            language: {
                search: "{{__('Search')}}",
                lengthMenu: "{{__('Show _MENU_ entries')}}",
                info: "{{__('Showing _START_ to _END_ of _TOTAL_ entries')}}",
                infoEmpty: "{{__('Showing 0 to 0 of 0 entries')}}",
                infoFiltered: "{{__('(filtered from _MAX_ total entries)')}}",
                paginate: {
                    first: "{{__('First')}}",
                    last: "{{__('Last')}}",
                    next: "{{__('Next')}}",
                    previous: "{{__('Previous')}}"
                }
            }
        });
    });
</script>
@endpush
