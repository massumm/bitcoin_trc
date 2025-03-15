@extends('layouts.master')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-4">Import Users</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div> --}}



    <!-- DataTales Example -->


        <div class="card mt-4">

        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('importMedicine') }}</h6>
        </div>
        {{-- <form method="POST" action="{{route('users.upload')}}" enctype="multipart/form-data"> --}}
        <form id="formCSVImport" method="POST" action="{{ url('admin/add-medicine') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-md-12 mb-3 mt-3">
                        {{-- <p>{{ __('pleaseUpload') }} <a href="#" >{{ __('sampleFormat') }}</a></p> --}}
                        <div class="col-md-12 mb-3 mt-3">
                            <p>{{ __('pleaseUpload') }} <a href="{{ url('uploads/sample/sample.csv') }}">{{ __('sampleFormat') }}</a></p>
                        </div>

                    </div>
                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-0 mb-sm-0">
                        <span style="color:red;">*</span>{{ __('fileInput') }}</label>
                        <input
                            type="file"
                            class="form-control form-control-user @error('file') is-invalid @enderror"
                            id="exampleFile"
                            name="file"
                            value="{{ old('file') }}"
                            >

                        @error('file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">

                <button id="submit" class="btn btn-success btn-user float-right mb-3" type="submit" role="button">
                    <i class="fa fa-upload"></i>&nbsp;{{__('uploadMedicineList')}}
                  </button>

                {{-- <button type="submit" class="btn btn-success btn-user float-right mb-3">Upload Users</button> --}}
                {{-- <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">Cancel</a> --}}
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ url('admin/add-medicine') }}">{{__('cancel')}}</a>
            </div>
        </form>
    </div>



</div>


@section('body_script')
  {{-- <script>
    $(document).ready(function() {
      $('#inputGroupFile').on('change',function(){
          //get the file name
          var fileName = $(this).val();
          //replace the "Choose a file" label
          $(this).next('.custom-file-label').html(fileName);
      });

      $("#formCSVImport").on("submit", function () {
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#inputGroupFile").val().toLowerCase())) {
            $("#response").append('<div class="d-flex justify-content-start"> <div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button> <strong class="px-1">{{__('app.invalid_csv')}}</strong> </div></div>');
            return false;
        }
        // Disable the submit button and add a spinner into it
        $("#submit").attr('disabled', true);
        $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;CSV Uploading...');

        return true;
      });
    });
  </script> --}}
@endsection('body_script')

@endsection
