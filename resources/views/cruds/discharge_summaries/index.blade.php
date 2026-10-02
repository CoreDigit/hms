@extends('users.' . activeGuard() . '.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Discharge Summaries</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <a href="{{ auth()->guard('doctor')->check() ? route('doctor.discharge_summaries.create') : route('discharge_summaries.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Discharge Summary</a>
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
                        <th>Summary ID</th>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Discharge Type</th>
                        <th>Final Diagnosis</th>
                        <th>Discharge Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($summaries as $s)
                        <tr>
                            <td><b>#DS-{{ $s->id }}</b></td>
                            <td>{{ $s->patient->name ?? 'N/A' }}</td>
                            <td>Dr. {{ $s->doctor->name ?? 'N/A' }}</td>
                            <td><span class="badge badge-info">{{ strtoupper($s->discharge_type) }}</span></td>
                            <td>{{ $s->final_diagnosis }}</td>
                            <td>{{ Carbon\Carbon::parse($s->discharge_date)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('discharge_summaries.print', $s->id) }}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print Summary</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No discharge summaries recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $summaries->links() }}
        </div>
    </div>
</div>
@endsection
