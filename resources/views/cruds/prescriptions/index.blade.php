@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Prescriptions List</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <a href="{{ route('prescriptions.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Prescription</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Rx ID</th>
                        <th>Date</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Diagnosis</th>
                        <th>Medicines Prescribed</th>
                        <th>Follow Up</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prescriptions as $rx)
                        <tr>
                            <td><b>#RX-{{ $rx->id }}</b></td>
                            <td>{{ Carbon\Carbon::parse($rx->prescription_date)->format('d M Y') }}</td>
                            <td>{{ $rx->patient->name ?? 'N/A' }} ({{ $rx->patient->phone ?? '' }})</td>
                            <td>Dr. {{ $rx->doctor->name ?? 'N/A' }}</td>
                            <td>{{ $rx->diagnosis ?? '-' }}</td>
                            <td><span class="badge badge-info">{{ $rx->items->count() }} Medicines</span></td>
                            <td>{{ $rx->follow_up_date ? Carbon\Carbon::parse($rx->follow_up_date)->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('prescriptions.print', $rx->id) }}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print Rx Slip</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No prescriptions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $prescriptions->links() }}
        </div>
    </div>
</div>
@endsection
