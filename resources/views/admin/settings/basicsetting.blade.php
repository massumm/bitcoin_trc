@extends('layouts.master')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
                   <div class="card-header">
                                  <h1 class="">{{__('basicSetup')}}</h1>
                   </div>

                   <div class="card-body">

                     @if ($errors->any())
                     <div class="alert alert-danger">

                         @foreach ($errors->all() as $error )
                         <div>{{$error}}</div>

                         @endforeach

                     </div>

                     @endif

                        <form action="{{ url('admin/add-basic-setting') }}" method="POST" enctype="multipart/form-data">

                                                 @csrf

                                                 {{-- <div class="mb-3">
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
                                                  </div> --}}

                                                  <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label  for="d_title" class="form-label">{{__('dashboardName')}}</label>
                                                        <input
                                                          type="text"
                                                          class="form-control"
                                                          id="d_title"
                                                          name="d_title"
                                                          value="{{ $basicSetting->d_title }}"

                                                        />
                                                      </div>
                                                      <div class="mb-3 col-md-6">
                                                        <label  class="form-label">{{__('tax')}}</label>
                                                        <input
                                                          type="integer"
                                                          class="form-control"
                                                          id="tax"
                                                          name="tax"
                                                          value="{{ $basicSetting->tax }}"

                                                        />
                                                      </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="currency" class="form-label">{{__('currency')}}</label>
                                                        <select id="currency" name="currency" class="select2 form-select">
                                                          <option value="">{{__('selectCurrency')}}</option>
                                                          <option value="$" {{ $basicSetting->currency == '$' ? 'selected' : '' }}>$</option>
                                                          <option value="¥" {{ $basicSetting->currency == '¥' ? 'selected' : '' }}>¥</option>


                                                        </select>
                                                      </div>
                                                    <div class="mb-3 col-md-6">
                                                      <label for="push_id" class="form-label">{{__('notificationID')}}</label>
                                                      <input
                                                        type="text"
                                                        class="form-control"
                                                        id="push_id"
                                                        name="push_id"
                                                        value="{{ $basicSetting->push_id }}"
                                                      />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="insurance_status" class="form-label">{{__('insurance')}}</label>
                                                        <select id="insurance_status" name="insurance_status" class="select2 form-select">
                                                          <option value="">{{__('selectInsuranceStatus')}}</option>
                                                          <option value="1" {{ $basicSetting->insurance_status == 1 ? 'selected' : '' }}>{{__('enable')}}</option>
                                                          <option value="0" {{ $basicSetting->insurance_status == 0 ? 'selected' : '' }}>{{__('disable')}}</option>

                                                        </select>
                                                      </div>
                                                    {{-- <div class="mb-3 col-md-6">
                                                      <label for="language" class="form-label">Language</label>
                                                      <select id="language" class="select2 form-select">
                                                        <option value="">Select Language</option>
                                                        <option value="en">English</option>
                                                        <option value="fr">French</option>
                                                        <option value="de">German</option>
                                                        <option value="pt">Portuguese</option>
                                                      </select>
                                                    </div> --}}


                                                  </div>


                                                    <button type="b_submit" class="btn btn-primary">{{__('updateSetup')}}</button>





                                  </form>


                   </div>

    </div>

</div>

@endsection
