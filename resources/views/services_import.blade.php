@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success">
 {{ session('status') }}
</div>
@endif

@include('breadcrumb.owner_breadcrumb')







<div class="container-fluid nss_style add-service-date">  


    @if (isset($serviceserrors) && count($serviceserrors) > 0)
    <div class="alert alert-danger" role="alert">
        <div class="error-message">
            <h2>Import Errors Found:</h2>
            <ul>
                @foreach ($serviceserrors as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif



    @if (isset($servicessuccess) && count($servicessuccess) > 0)
    <div class="alert alert-success" role="alert">
        <div class="error-message">
            <ul>
                @foreach ($servicessuccess as $success)
                <li>{{ $success }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    



    <div class="d-sm-flex align-items-center justify-content-between mb-4">


      <h1 class="h3 mb-0 text-gray-800">
        <span class="rental insert_dates"><a href="{{ route('home.manage') }}">Manage</a> </span> 
        >>
        <span class="rental insert_dates"><a href="{{ route('services.index') }}">View Dates</a> </span>
        >>
        <span class="insert_dates">Import Dates </span>
    </h1>

    <p class="mb-1">
        <a href="{{ asset('images/services (1).csv') }}" class="text-blue-600 hover:text-blue-800 underline">
            <i class="fas fa-download mr-1"></i> Download sample CSV file
        </a>
        <span class="text-sm text-gray-600 block mt-1">This demo file shows the required format for successful imports.</span>
    </p>

    <p>Please verify that the Checkout Date is always after the Arrival Date, and confirm each unit exists in the database. Any records with invalid dates (Checkout ≤ Arrival) or non-existent units should be automatically skipped.</p>
</div>

<div class="row justify-content-center"> 
    <div class="col-xl-12 col-lg-12 col-md-12 mb-4"> 
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-boldx">Import Dates from CSV</h6>
            </div>

            <div class="card-body">
                <form id="import_dates_form" class="user-add" method="POST" action="" enctype="multipart/form-data">
                    @csrf 
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12"> 
                            <div class="mb-3">
                                <label for="file" class="form-label">{{ __('Select The File to Import Dates') }}</label>
                                <input id="file" type="file" class="form-control" name="file" accept=".csv" required>

                                <div class="form-text text-muted">
                                    Please select a CSV file containing the dates to import.
                                </div>
                            </div>

                            <div class="mb-3"> 
                                <button type="submit" class="btn btn-primary" id="submit_import_btn">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <span class="button-text">Submit</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





</div>

@endsection