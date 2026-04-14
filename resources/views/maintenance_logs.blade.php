@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="container-fluid">
    <div class="container-fluid nss_style">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <span class="rental insert_dates">Maintenance Log</span>
            </h1>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="row mb-3">
                    <div class="col-md-4 offset-md-4 col-form-label text-md-end">
                        <label for="unit_type" class="col-form-label text-md-end">{{ __('Select The Unit # to View Logs') }}</label>
                        <select id="unit_type" class="form-control">
                            <option value="{{ route('maintenance-log.index') }}">All Units</option>
                            @foreach(unit_type_array() as $unit)
                            <option value="{{ route('maintenance-log.by_unit', $unit->id) }}" {{ $unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @if ($unit_id)
                        <span class="all_dates"><a href="{{ route('maintenance-log.index') }}">View All Units</a></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-sm-flex align-items justify-content-end mr-2 mb-4">
            <div><a href="{{ route('maintenance-log.create') }}" class="btn btn-primary">Add Maintenance Entry</a></div>
        </div>

        <div class="col-xl-12 col-md-12 mb-4">
            @if ($logs->isNotEmpty())

            {{-- Mobile view --}}
            <div class="date_mobile_section">
                @foreach ($logs as $log)
                <div class="services_date_detail">
                    <div class="services_date_name">
                        <div class="unit"><strong>Unit# </strong>{{ get_unit_detail($log->unit_id)->name }}</div>
                        <div class="arrival_date"><strong>Date </strong><span class="arrival_departure_date_value">{{ \Carbon\Carbon::parse($log->date)->format('F d, Y') }}</span></div>
                        <div class="unit"><strong>Amount </strong> ${{ number_format($log->amount, 2) }}</div>
                    </div>

                    <div class="services_date_detail_more">
                        <div class="services_date_detail_action" style="display: none;">
                            <div><strong>Description </strong> {{ $log->description }}</div>
                            <div><strong>Created At </strong> {{ \Carbon\Carbon::parse($log->created_at)->format('l, d F Y \a\t h:i A') }}</div>
                            &nbsp;
                            <div class="action">
                                <form method="post" action="{{ route('maintenance-log.destroy', $log->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm mb-1 delete-btn"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <span class="date_detail_more"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                    </div>
                </div>
                @endforeach
                {!! $logs->links() !!}
            </div>

            {{-- Desktop view --}}
            <div class="date_desktop_section service-table">
                <table class="service-table table table-bordered">
                    <thead>
                        <tr>
                            <th>Unit #</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                        <tr>
                            <td>{{ get_unit_detail($log->unit_id)->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->date)->format('F d, Y') }}</td>
                            <td>{{ $log->description }}</td>
                            <td>${{ number_format($log->amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->format('l, d F Y \a\t h:i A') }}</td>
                            <td class="action">
                                <form method="post" action="{{ route('maintenance-log.destroy', $log->id) }}" class="delete-form">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm mb-1 delete-btn"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $logs->links() !!}
            </div>

            @else
            <p>No maintenance log entries found.</p>
            @endif
        </div>

        <div class="modal fade" id="maintenanceconfirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form" class="form-horizontal">
                        <div class="modal-body">
                            <h4 align="center" style="margin: 0;">Are you sure you want to delete this entry?</h4>
                            <p>You cannot undo this action.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
