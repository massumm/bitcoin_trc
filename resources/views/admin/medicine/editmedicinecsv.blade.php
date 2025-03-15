@extends('layouts.master')
@section('content')
<div class="card mt-4">
    <div class="card-header">
                   <h1 class="">Edit Medicine</h1>
    </div>

    <div class="card-body">

      @if ($errors->any())
      <div class="alert alert-danger">

          @foreach ($errors->all() as $error )
          <div>{{$error}}</div>

          @endforeach

      </div>

      @endif

         <form action="{{ url('admin/update-medicine/'.$Medicine_id->id) }}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="mb-3">
                                                 <label for="">Medicine Title</label>
                                                 <input type="text"  value="{{$Medicine_id->title}}" name="title" class="form-control">
                                  </div>

                                  <div class="mb-3">
                                     <label for="">Upload Medicine Image</label>
                                     <input type="file" name="image" class="form-control">
                                 </div>

                                  <div class="mb-3">
                                                 <label for="">Medicine Type</label>
                                                 <input type="text" name="type" value="{{$Medicine_id->type}}"  class="form-control">
                                  </div>
                                  <div class="mb-3">
                                    <label for="">Medicine Price</label>
                                    <input type="text" name="price" value="{{$Medicine_id->price}}"  class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="">Medicine discount</label>
                                    <input type="text" name="discount" value="{{$Medicine_id->discount}}"  class="form-control">
                                </div>
                      

                                <div class="mb-3">
                                    <label class="form-label" for="country">Stock Status</label>
                                    <select id="select" name="stock_status" class="select2 form-select">
                                        <option value="1" {{ $Medicine_id->stock_status == 1 ? 'selected' : '' }}>In Stock</option>
                                        <option value="0" {{$Medicine_id->stock_status == 0 ? 'selected' : '' }}>Out Of Stock</option>
                                   
                                    </select>
                                  </div>
                            

                           
                              

                                  <div class="mb-3">
                                                 <label for="">Medicine Description</label>
                                                 <textarea name="description"  rows="5" class="form-control">{{$Medicine_id->description}}</textarea>
                                  </div>

                                  <div class="col-md-6">
                                     <button type="submit" class="btn btn-primary">Update Category</button>
                                 </div>

                   </form>

    </div>

</div>
@endsection
