@extends('layouts.master')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('assets/summernote/summernote-lite.min.css') }}"> --}}
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<div class="container-fluid px-4">

    <div class="card mt-4">
                   <div class="card-header">
                                  <h1 class="">Pages Setup</h1>
                   </div>

                   <div class="card-body">

                     @if ($errors->any())
                     <div class="alert alert-danger">

                         @foreach ($errors->all() as $error )
                         <div>{{$error}}</div>

                         @endforeach

                     </div>

                     @endif
   
        
                        <form action="{{ url('admin/add-pages-setting') }}" method="POST" enctype="multipart/form-data">

                                                 @csrf
                                                 <div class="mb-3">
                                                    <div class="form-group">
                                                        <label><strong> Privacy Policy</strong></label>
                                                        <textarea class="form-control" id="privacy" name="privacy" >{{ $pageSetting->privacy }}</textarea>
                                                        
                                                    </div>
                                                    </div> 

                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label><strong> About Us</strong> </label>
                                                            
                                                            <textarea class="form-control" id="about" name="about"  >{{ $pageSetting->about }}</textarea>
                                                            
                                                        </div>
                                                        </div>

                                                        	
										<div class="mb-3">
                                            <div class="form-group">
                                                <label><strong> Contact Us</strong> </label>
                                                <textarea class="form-control" id="contact" name="contact"  >{{ $pageSetting->contact }}</textarea>
                                                
                                            </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label><strong> Terms & Conditions</strong> </label>
                                                    <textarea class="form-control" id="terms" name="terms">{{ $pageSetting->terms }}</textarea>
                                                    
                                                </div>
                                                </div>
                                                <div class="card-footer text-left">
                                                  <button type="usetting" class="btn btn-primary">Update Setting</button>
                                              </div>
                                               

                                  </form>
                           
           
                   </div>
               
            

    </div>

</div>

<script>
  $('#privacy').summernote({
    placeholder: '----',
    tabsize: 2,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
    ]
  });

  $('#about').summernote({
    placeholder: '----',
    tabsize: 2,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
    ]
  });


  $('#contact').summernote({
    placeholder: '-----',
    tabsize: 2,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
    ]
  });

  $('#terms').summernote({
    placeholder: '-----',
    tabsize: 2,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
    ]
  });

  
</script>


@endsection
