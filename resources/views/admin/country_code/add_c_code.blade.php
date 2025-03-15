@extends('layouts.master')
@section('content')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<div class="container-fluid px-4">

    <div class="card mt-4">
                   <div class="card-header">
                                  <h1 class="">Add Country Code</h1>
                                  <button type="C_submit" onclick="login()" class="btn btn-primary">Add Country Code</button>
                   </div>

                   <div class="card-body">

                     @if ($errors->any())
                     <div class="alert alert-danger">

                         @foreach ($errors->all() as $error )
                         <div>{{$error}}</div>

                         @endforeach

                     </div>

                     @endif

                        <form action="{{ url('admin/add-Country-Code') }}" method="POST" enctype="multipart/form-data">

                                                 @csrf
                                                 <div class="mb-3">
                                                                <label for="">Country Code
                                                                </label>
                                                                <input type="text" name="c_code" class="form-control"placeholder ="Enter Country Code">
                                                 </div>
 
                                                  <div class="mb-3">
                                                    <label class="form-label" for="country">Country Code Status</label>
                                                    <select id="select" name="status" class="select2 form-select">
                                                      <option value="1">Publish</option>
                                                      <option value="0">Unpublish</option>
                                                   
                                                    </select>
                                                  </div>

                                                 

                                                    <button type="C_submit" onclick="login()" class="btn btn-primary">Add Country Code</button>
                                    
                                                    {{-- <button type="submit" class="btn btn-success btn-user float-right mb-3">Upload Users</button> --}}
                                                    {{-- <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">Cancel</a> --}}
                                                    <a class="btn btn-success" href="{{ url('admin/view-country-code') }}">View Country Code</a>
                                                    {{-- btn btn-success btn-user float-right mb-3 --}}
                                            
                                               

                                  </form>
                             
                            
                   </div>

    </div>
    <script>
      function login(){


$.ajax({
                    url: "http://127.0.0.1:8000/api/line/31?line_id=lineeesksdfmkass",
                    method: 'PUT',
					// data: {
					// 	           email_or_mobile: '01982255978',
          //              password: '12345678'
                      
          //           },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log($('meta[name="csrf-token"]').attr('content'));
                        
                    
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                }
				);
        
      }
 </script>
</div>

 @endsection