@extends('layouts.minimal')

@section('title', __('messages.platform_instruction'))

@section('content')

<div class="card p-3">

        <h5 > {{ __('messages.instruction_header_title1') }}</h5>
            <p>
            {{ __('messages.insctruction_1_1') }}
      </p>
            
            <p class="mb-3">
            {{ __('messages.insctruction_1_2') }}
      </p>
            
            <p class="mb-3">
            {{ __('messages.insctruction_1_3') }}
 </p>
            
            <p class="mb-3">
            {{ __('messages.insctruction_1_4') }}
 </p>
            
        <h5 > {{ __('messages.instructin_header_title2') }}</h5>

        <p class="mb-3">
        {{ __('messages.insctruction_2_1') }}   </p>
        <p class="mb-3">
        {{ __('messages.insctruction_2_2') }}
     </p>
        <p>
        {{ __('messages.insctruction_2_3') }}
    </p>
<h5 >   {{ __('messages.instructin_header_title3') }}</h5>
<p> {{ __('messages.insctruction_3_1') }}</p>
<p> {{ __('messages.insctruction_3_1_2') }}</p> 
<p> {{ __('messages.insctruction_3_2') }}</p> 
<p>{{ __('messages.insctruction_3_2_2') }} </p>
<p>{{ __('messages.insctruction_3_3') }}</p>
<p>{{ __('messages.insctruction_3_4') }}</p>    

</div>

<style>

</style>

@endsection
