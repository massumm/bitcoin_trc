@extends('layouts.master')
@section('content')

 <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                        <div class="card-body">
                            <div>
                                <h3>{{__('paymentList')}}</h3>
                                <div class="table-responsive text-nowrap">
                                  <table id="myDataTable" class="table" width="100%" cellspacing="0">
                                      <thead>
                                          <tr>
                                              <th>{{__('id')}}</th>
                                              <th>{{__('payment')}}
                                               <br> {{__('gatewayName')}}</th>
                                              <th>{{__('payment')}}<br>{{__('gatewaySubtitle')}}</th>
                                              <th>{{__('payment')}}<br>{{__('gatewayImage')}}</th>
                                              <th>{{__('payment')}}<br>{{__('gatewayStatus')}}</th>
                                              <th>{{__('action')}}</th>


                                          </tr>
                                      </thead>
                                      <tbody class="table-border-bottom-0">
                                          <!-- Table rows -->

                                          @foreach ($paymentlistmodel as $payment)
                                              <tr>
                                                  <td>{{ $payment->id }}</td>
                                                  <td>{{ $payment->title }}</td>
                                                  <td>{{ $payment->subtitle }}</td>
                                                  <td>  <img src="{{ asset($payment->img)}}" width="50px" height="50px" alt="Img"></td>
                                                  <td>

                                                          @if ($payment->status == 1)
                                                          <span class="badge rounded-pill bg-success">{{__('publish')}}</span>
                                                      @else
                                                          <span class="badge rounded-pill bg-danger">{{__('unpublish')}}</span>
                                                      @endif


                                                  </td>
                                                  <td>
                                                      {{-- <a data-bs-toggle="modal" href="{{url('admin/add-payment-list/'.$payment->id)}}"
                                                          data-bs-target="#exampleModal"
                                                          type="button"class="btn btn-primary">Edit</a> --}}
                                                          <a href="{{url('admin/add-payment-list/'.$payment->id)}}" class="btn btn-primary">{{__('edit')}}</a>

                                                  </td>


                                              </tr>
                                          @endforeach
                                      </tbody>

                                  </table>
                              </div>
                            </div>
                        </div>
                  </div>
                </div>
              </div>

 </div>

@endsection
