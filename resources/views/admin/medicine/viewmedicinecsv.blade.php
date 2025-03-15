@extends('layouts.master')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">

        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h4>{{__('viewData')}}</h4>
                </div>
                <div class="col-auto">
                    <a  href="{{ url('admin/download-medicines') }}"class="btn btn-sm btn-success">
                        <i class="fas fa-download mr-2"></i>{{__('downloadCSV')}}
                    </a>
                </div>



            </div>

        </div>
        <div class="card-body">


            <table id="myDataTable" class="table" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>{{__('productID')}}</th>
                        <th>{{__('image')}}</th>
                        <th>{{__('medicineTitle')}}</th>
                        <th>{{__('medicineType')}}</th>
                        <th>{{__('timeInDay')}}</th>
                        <th>{{__('numberPieses')}}</th>
                        <th>{{__('timing')}}</th>
                        <th>{{__('stockStatus')}}</th>
                        <th>{{__('price')}}</th>
                        <th>{{__('action')}}</th>

                    </tr>
               </thead>

               <tbody class="table-border-bottom-0">
                @foreach ($medicineListModel as $item )
                    <tr>
                        <td>{{ $item->product_id }}</td>
                        <td>
                            <img src="{{ asset($item->image)}}" width="50px" height="50px" alt="Img">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->type}}</td>
                        <td>{{ $item->daily_dose}}</td>
                        <td>{{ $item->piese_per_dose}}</td>
                        {{-- <td>{{ $item->instruction}}</td> --}}

                        <td>
                            @if ($item->instruction == 1)
                                <span class="badge bg-label-primary me-1">{{__('before')}}</span>
                            @elseif ($item->instruction == 2)
                                 <span class="badge bg-label-warning me-1">{{__('any')}}</span>
                            @else
                                <span class="badge bg-label-info me-1">{{__('after')}}</span>
                            @endif
                        </td>

                        <td>
                            @if ($item->stock_status == 1)
                                <span class="badge bg-label-primary me-1">{{__('inStock')}}</span>
                            @else
                                <span class="badge bg-label-danger me-1">{{__('outStock')}}</span>
                            @endif
                        </td>
                        <td>{{ $item->price}}</td>

                        {{-- <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                                </div>
                            </div>
                        </td> --}}



                        <td>
                            <a href="{{url('admin/edit-medicine/'.$item->id)}}"  class="btn btn-primary">{{__('edit')}}</a>
                            <a  href="{{url('admin/delete-medicine/'. $item->id)}}" class="btn btn-danger">{{__('delete')}}</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>


            </table>

        </div>
    </div>


</div>


@endsection
