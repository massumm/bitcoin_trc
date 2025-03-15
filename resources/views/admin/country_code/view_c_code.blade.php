@extends('layouts.master')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
                   <div class="card-header">
                    @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                                  <h1 class="">{{__('countryCodeList')}}</h1>
                                  <div class="table-responsive text-nowrap">
                                  <table id="myDataTable" class="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('countryCode')}}</th>
                                            <th>{{__('status')}}</th>
                                            <th>{{__('action')}}</th>

                                        </tr>
                                    </thead>
                                    <tbody  class="table-border-bottom-0">
                                        <!-- Table rows -->
                                        @foreach($CountryCodes as $code)
                                        <tr>
                                            <td>{{ $code->id }}</td>
                                            <td>{{ $code->c_code }}</td>
                                            <td> @if($code->status == 1)
                                                <span class="badge bg-label-primary me-1">  {{__('publish')}}</span>
                                                @else
                                                <span class="badge bg-label-danger me-1">  {{__('unpublish')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('admin/edit-country-code/'.$code->id)}}" class="btn btn-primary">{{__('edit')}}</a>
                                                <a href="{{url('admin/delete-country-code/'.$code->id)}}" class="btn btn-danger">{{__('delete')}}</a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                   </div>





    </div>

</div>
 @endsection
