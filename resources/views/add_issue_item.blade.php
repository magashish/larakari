@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

@include('breadcrumb.owner_breadcrumb')

<div class="container-fluid nss_style add-service-date">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <span class="rental insert_dates"><a href="{{ route('issue-items.index') }}">Issue Items</a></span>
            >>
            <span class="insert_dates">Add Issue</span>
        </h1>
    </div>

    <div class="row">
        <div class="col-xl-8 col-md-10 mb-4 offset-xl-2 offset-md-1">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('issue-items.store') }}">
                        @csrf
                        <input type="hidden" name="type" value="issue">

                        <div class="row mb-3">
                            <label for="unit_id" class="col-md-4 col-form-label text-md-end">{{ __('Unit #') }} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select id="unit_id" name="unit_id" class="form-control @error('unit_id') is-invalid @enderror" required>
                                    <option value="">Select Unit #</option>
                                    @foreach(unit_type_array() as $unit)
                                    <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required onkeydown="return false;">
                                @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Issue Description') }} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('Amount ($)') }} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="number" id="amount" name="amount" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                                @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                <a href="{{ route('issue-items.index') }}" class="btn btn-secondary ms-2">{{ __('Cancel') }}</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
