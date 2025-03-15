@extends('layouts.master')
@section('content')
{{-- 
 <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                        <div class="card-body">
                            <div>
                                <h3>Add Payment </h3>
                               
                            </div>
                        </div>
                  </div>
                </div>
              </div>
          
 </div> --}}
 <div class="container-xxl flex-grow-1 container-p-y">
<div class="card mt-4">
    <div class="card-header">
                   <h1 class="">Add Payment </h1>
    </div>

    <div class="card-body">

      @if ($errors->any())
      <div class="alert alert-danger">

          @foreach ($errors->all() as $error )
          <div>{{$error}}</div>

          @endforeach

      </div>

      @endif

         <form action="{{ url('admin/update-payment-list/'.$payment_id->id) }}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="mb-3">
                                                 <label for="">Payment Gateway Name</label>
                                                 <input type="text"  value="{{$payment_id->title}}" name="title" disabled class="form-control">
                                  </div>
                                  <div class="mb-3">
                                    <label for="">Payment Gateway SubTitle</label>
                                    <input type="text"  value="{{$payment_id->subtitle}}" name="subtitle" class="form-control">
 
                                   </div>

                                  <div class="mb-3">
                                     <label for="">Payment Gateway Image</label>
                                     <input type="file" name="img" class="form-control">
                                     <img src="{{ asset($payment_id->img)}}" width="50px" height="50px" alt="Img">
                                 </div>

                                  <div class="mb-3">
                                                 <label for="">Payment Gateway Attributes</label>
                                                 <input type="text" name="attributes" value="{{$payment_id->attributes}}"  class="form-control">
                                  </div>
                                

                                <div class="mb-3">
                                    <label class="form-label" for="country">Payment Gateway Status</label>
                                    <select id="select" name="status" class="select2 form-select">
                                        <option value="1" {{ $payment_id->status == 1 ? 'selected' : '' }}>In Stock</option>
                                        <option value="0" {{$payment_id->status == 0 ? 'selected' : '' }}>Out Of Stock</option>
                                   
                                    </select>
                                  </div>
                            

                                  <div class="col-md-6">
                                     <button type="submit" class="btn btn-primary">Update Payment Gateway</button>
                                 </div>

                   </form>

    </div>

</div>
 </div>

@endsection
