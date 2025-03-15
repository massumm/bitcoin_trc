@extends('layouts.master')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
                   <div class="card-header">
                    @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                                  <h1 class="">{{__('customerList')}}</h1>
                                  <div class="table-responsive text-nowrap">
                                  <table id="myDataTable" class="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('userName')}}</th>
                                            <th>{{__('userNumber')}}</th>
                                            <th>{{__('status')}}</th>
                                            <th>{{__('action')}}</th>

                                        </tr>
                                    </thead>
                                    <tbody  class="table-border-bottom-0">
                                        <!-- Table rows -->
                                        @foreach($UsersList as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->fname }}</td>
                                            <td>{{ $user->mobile }}</td>
                                            <td> @if($user->status == 1)
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
                                                <a href="{{url('admin/delete-userslist/'.$user->id)}}" onclick="return confirmDelete()" class="btn btn-danger">{{__('delete')}}</a>
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
