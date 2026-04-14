@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success">
 {{ session('status') }}
</div>
@endif


@include('breadcrumb.owner_breadcrumb')

<div class="container-fluid nss_style unit-service-edit">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Edit Date</h1>
</div>

<div class="row">    
  <div class="col-xl-12 col-md-12 mb-4 unit_title">
    <div class="row mb-3">
        <div class="col-md-12 col-form-label text-md-end">
            <label for="unit_type" class="col-form-label text-md-end">{{ __('Unit #:')}}  <span class="unit_id">{{ get_unit_detail($service->unit)->name }}</span></label>           
        </div>       
    </div>
</div>
</div>


@php
 $room_code=get_unit_detail($service->unit)->room_code;
@endphp

<div class="row">
  <div class="col-xl-12 col-md-12 mb-4 service-edit">
    @if($errors->has('custom_error'))
    <div class="alert alert-danger">
        {{ $errors->first('custom_error') }}
    </div>
    @endif

    <form class="input-form"  method="POST" action="{{ route('owner-services.update', $service->id) }}" enctype="multipart/form-data">
       @csrf
       @method('PUT')


    <!-- <div class="row mb-3">
        <label for="unit" class="col-md-4 col-form-label text-md-end">{{ __('Unit') }}</label>

        <div class="col-md-6">
         <select id="unit" class="form-control @error('unit') is-invalid @enderror" name="unit" required>
           @foreach(unit_type_owner_array(auth()->user()->id) as $key => $value)
            <option value="{{ $value->id }}" @if( $service->unit == $value->id) selected @endif>{{ $value->name }}</option>
            @endforeach
        </select>
        @error('unit')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div> -->

   {{--  <div class="row mb-3">
        <label for="bed_type" class="col-md-4 col-form-label text-md-end">{{ __('Bed Type') }}</label>

        <div class="col-md-6">
            <!-- <input id="bed_type" type="text" class="form-control @error('bed_type') is-invalid @enderror" name="bed_type" value="{{ $service->bed_type }}" required> -->

            <select id="bed_type" class="form-control @error('bed_type') is-invalid @enderror" name="bed_type" required>
                @foreach(bed_type_array() as $key => $value)
                <option value="{{ $key }}" @if($service->bed_type == $key) selected @endif>{{ $value }}</option>
                @endforeach
            </select>

            @error('bed_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div> --}}

    <div class="row mb-3">
        <label for="guest_name" class="col-md-4 col-form-label text-md-end">{{ __('Guest Name') }}</label>

        <div class="col-md-6">
            <input id="guest_name" type="text" class="form-control @error('guest_name') is-invalid @enderror" name="guest_name" value="{{ $service->guest_name }}" required>

            @error('guest_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="arrival_date" class="col-md-4 col-form-label text-md-end">{{ __('Arrival Date') }}</label>

        <div class="col-md-6">
           <input id="arrival_date" type="date" class="form-control @error('arrival_date') is-invalid @enderror"  value="{{ \Carbon\Carbon::parse($service->arrival_date)->format('Y-m-d') }}" required disabled>

           @error('arrival_date')
           <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="arrival_date" class="col-6 col-md-4 col-form-label text-md-end">{{ __('Arrival Time') }}</label>
    <div class="col-6">
        <span class="form-control">{{ \Carbon\Carbon::parse($service->arrival_date)->format('H:i:s') !== '00:00:00' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '' }}</span>
 </div>
</div>

<div class="row mb-3">
    <label for="checkin" class="col-6 col-md-4 col-form-label text-md-end">{{ __('Early Check In') }}</label>
    <div class="col-6">
        <input type="checkbox" class="form-control checkin @error('checkin') is-invalid @enderror"  value="1" {{ $service->checkin == 1 ? 'checked' : '' }} disabled>         

    </div>
</div>

<div class="arrival_time_div" style="display:{{ $service->checkin == 1 ? 'block;' : 'none;' }}">
<div class="row mb-3">
    <label for="arrival_time" class="col-md-4 col-form-label text-md-end">{{ __('Time') }}</label>
    <div class="col-md-6">

        <select id="arrival_time"  class="form-control " tabindex="-1" aria-hidden="true"  disabled> 
            @foreach (insert_checkin_time_array() as $key=> $arrival_time) 
            <option value="{{ $key }}" {{ $service->arrival_time == $key ? 'selected' : '' }}>{{ $arrival_time }}</option> 
            @endforeach
        </select>

        @error('arrival_time')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
</div>

<div class="row mb-3">
    <label for="departure_date" class="col-md-4 col-form-label text-md-end">{{ __('Checkout Date') }}</label>

    <div class="col-md-6">
        <input id="departure_date" type="date" class="form-control @error('departure_date') is-invalid @enderror"  value="{{ \Carbon\Carbon::parse($service->departure_date)->format('Y-m-d') }}"  disabled> 


        @error('departure_date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="arrival_date" class="col-6 col-md-4 col-form-label text-md-end">{{ __('Checkout Time') }}</label>
    <div class="col-6">
     <span class="form-control">{{ \Carbon\Carbon::parse($service->departure_date)->format('H:i:s') !== '00:00:00' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '' }}</span> 
 </div>
</div>


<div class="row mb-3">
    <label for="checkout" class="col-6 col-md-4 col-form-label text-md-end">{{ __('Late Checkout') }}</label>
    <div class="col-6">
        <input type="checkbox" class="form-control edit_checkout checkout @error('checkout') is-invalid @enderror"  value="1" {{ $service->checkout == 1 ? 'checked' : '' }} disabled>         
    </div>
</div>

<div class="departure_time_div" style="display:{{ $service->checkout == 1 ? 'block;' : 'none;' }}">
<div class="row mb-3">
    <label for="departure_time" class="col-md-4 col-form-label text-md-end">{{ __('Time') }}</label>
    <div class="col-md-6">

       <select id="departure_time"  class="form-control " tabindex="-1" aria-hidden="true" disabled> 
            @foreach (insert_checkout_time_array() as $key=> $departure_time) 
            <option value="{{ $key }}" {{ $service->departure_time == $key ? 'selected' : '' }}>{{ $departure_time }}</option> 
            @endforeach
        </select>

       @error('departure_time')
       <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div>
</div>

<div class="row mb-3">
    <label for="room_code" class="col-md-4 col-form-label text-md-end">{{ __('Room Code') }}</label>
    <div class="col-md-6">
        <input id="room_code" type="text" class="form-control @error('room_code') is-invalid @enderror" value="{{ $service->room_code }}" @if($room_code) required @endif disabled>

        @error('room_code')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>



<div class="row mb-3">
    <label for="notes" class="col-md-4 col-form-label text-md-end">{{ __('Notes') }}</label>
    <div class="col-md-6">
        <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes">{{ $service->notes }}</textarea>

        @error('notes')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>





<div class="row mb-3">
    <div class="col-md-6 offset-md-4">
        <a href="{{ route('owner-services.index') }}" class="btn btn-primary">{{ __('Go Back') }}</a>
        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
    </div>
</div>
</form>







</div>
</div>
</div>

@endsection