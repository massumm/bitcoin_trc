@extends('layouts.master')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
                   <div class="card-header">
                                  <h1 class="">Edit Country Code</h1>
                   </div>

                   <div class="card-body">

                     @if ($errors->any())
                     <div class="alert alert-danger">

                         @foreach ($errors->all() as $error )
                         <div>{{$error}}</div>

                         @endforeach

                     </div>

                     @endif

                        <form action="{{ url('admin/update-country-code/'.$CountryCodes->id) }}" method="POST" enctype="multipart/form-data">

                                                 @csrf
                                                 @method('PUT')
                                                
                                                 <div class="mb-3">
                                                                <label for="">Country Code
                                                                </label>
                                                                <input type="text" name="c_code" value="{{$CountryCodes->c_code}}" class="form-control"placeholder ="Enter Country Code">
                                                 </div>
 
                                                  <div class="mb-3">
                                                    <label class="form-label" for="country">Country Code Status</label>
                                                    <select id="select" name="status" class="select2 form-select">
                                                        <option value="1" {{ $CountryCodes->status == 1 ? 'selected' : '' }}>Publish</option>
                                                        <option value="0" {{ $CountryCodes->status == 0 ? 'selected' : '' }}>Unpublish</option>
                                                   
                                                    </select>
                                                  </div>

                                                 

                                                    <button type="C_submit" class="btn btn-primary">Update Country Code</button>
                                                    <a class="btn btn-success" href="{{ url('admin/view-country-code') }}">View Country Code</a>
                                       
                                            
                                               

                                  </form>
                             
                            
                   </div>

    </div>

</div>
 @endsection