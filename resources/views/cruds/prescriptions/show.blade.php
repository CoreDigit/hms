@extends('users.' . activeGuard() . '.layouts.master')
@extends('cruds.layouts.show')

@section('title')
    {{ __('Prescription #') . $prescription->id }}
@endsection

@section('card-handle')
    <a href="{{ route('prescriptions.print', $prescription->id) }}" target="_blank" class="btn btn-primary"><i class="fas fa-print mr-1"></i> {{ __('Print Slip') }}</a>
    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary ml-2">{{ __('Back to List') }}</a>
@endsection

@section('card-body')
<div class="p-4">
    <div class="row mb-4 border-bottom pb-3">
        <div class="col-md-6">
            <h4 class="text-primary font-weight-bold">Dr. {{ $prescription->doctor->name ?? 'Doctor' }}</h4>
            <p class="text-muted mb-0">{{ $prescription->doctor->department->name ?? 'Specialist' }}</p>
        </div>
        <div class="col-md-6 text-md-right">
            <h5><strong>Rx #{{ $prescription->id }}</strong></h5>
            <p class="text-muted mb-0">Date: {{ \Carbon\Carbon::parse($prescription->prescription_date)->format('d M Y') }}</p>
        </div>
    </div>

    <div class="row mb-4 bg-light p-3 rounded">
        <div class="col-md-4">
            <strong>Patient Name:</strong> {{ $prescription->patient->name ?? 'N/A' }}
        </div>
        <div class="col-md-4">
            <strong>Age / Gender:</strong> {{ $prescription->patient->age ?? '-' }} Yrs / {{ ucfirst($prescription->patient->gender ?? '-') }}
        </div>
        <div class="col-md-4">
            <strong>Diagnosis:</strong> {{ $prescription->diagnosis }}
        </div>
    </div>

    @if($prescription->chief_complaints)
        <div class="mb-3">
            <h6 class="font-weight-bold text-dark">Chief Complaints:</h6>
            <p class="text-secondary">{{ $prescription->chief_complaints }}</p>
        </div>
    @endif

    <h5 class="font-weight-bold text-primary mb-3">Prescribed Medicines</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>#</th>
                    <th>Medicine Name</th>
                    <th>Dosage</th>
                    <th>Frequency</th>
                    <th>Duration</th>
                    <th>Instructions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prescription->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $item->medicine_name ?? ($item->medicine->name ?? 'N/A') }}</strong></td>
                        <td>{{ $item->dosage ?: '-' }}</td>
                        <td>{{ $item->frequency ?: '-' }}</td>
                        <td>{{ $item->duration ?: '-' }}</td>
                        <td>{{ $item->instructions ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No medicines prescribed.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($prescription->advice)
        <div class="mt-4 p-3 border rounded bg-white">
            <h6 class="font-weight-bold text-dark">Doctor Advice / Remarks:</h6>
            <p class="mb-0 text-secondary">{{ $prescription->advice }}</p>
        </div>
    @endif
</div>
@endsection
