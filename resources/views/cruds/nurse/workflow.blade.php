@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Nurse Patient Care & Vitals Entry</h4>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">Record Patient Vitals</div>
            <div class="card-body">
                <form action="{{ route('nurse_vitals.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Select Patient <span class="text-danger">*</span></label>
                        <select name="patient_id" class="form-control select2" required>
                            <option value="">-- Choose Patient --</option>
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}" {{ $patientId == $p->id ? 'selected' : '' }}>{{ $p->name }} (UHID: {{ $p->uhid ?? 'N/A' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6 form-group mb-2">
                            <label>BP Systolic (mmHg)</label>
                            <input type="number" name="bp_systolic" class="form-control" placeholder="120">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label>BP Diastolic (mmHg)</label>
                            <input type="number" name="bp_diastolic" class="form-control" placeholder="80">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 form-group mb-2">
                            <label>Pulse Rate (bpm)</label>
                            <input type="number" name="pulse_rate" class="form-control" placeholder="72">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label>Temperature (°F)</label>
                            <input type="number" step="0.1" name="temperature" class="form-control" placeholder="98.6">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 form-group mb-2">
                            <label>SpO2 (% Oxygen)</label>
                            <input type="number" name="spo2" class="form-control" placeholder="98">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label>Blood Sugar (mg/dL)</label>
                            <input type="number" step="0.1" name="blood_sugar" class="form-control" placeholder="110">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 form-group mb-2">
                            <label>Weight (kg)</label>
                            <input type="number" step="0.1" name="weight" class="form-control" placeholder="65.5">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label>Height (cm)</label>
                            <input type="number" step="0.1" name="height" class="form-control" placeholder="170">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Vitals Observations / Remarks</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Patient condition normal, stable..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-heartbeat"></i> Save Vitals Log</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-dark text-white">Recent Vitals Records</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>Date/Time</th>
                                <th>Patient</th>
                                <th>BP</th>
                                <th>Pulse</th>
                                <th>Temp</th>
                                <th>SpO2</th>
                                <th>Sugar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vitals as $v)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($v->recorded_at)->format('d M h:i A') }}</td>
                                    <td>{{ $v->patient->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($v->bp_systolic && $v->bp_diastolic)
                                            <b>{{ $v->bp_systolic }}/{{ $v->bp_diastolic }}</b>
                                        @else - @endif
                                    </td>
                                    <td>{{ $v->pulse_rate ? $v->pulse_rate . ' bpm' : '-' }}</td>
                                    <td>{{ $v->temperature ? $v->temperature . ' °F' : '-' }}</td>
                                    <td>
                                        @if($v->spo2)
                                            <span class="badge {{ $v->spo2 < 94 ? 'badge-danger' : 'badge-success' }}">{{ $v->spo2 }}%</span>
                                        @else - @endif
                                    </td>
                                    <td>{{ $v->blood_sugar ? $v->blood_sugar . ' mg/dL' : '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="7">No vitals logged yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $vitals->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
