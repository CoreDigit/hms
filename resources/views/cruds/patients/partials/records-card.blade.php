@php
    $route = match (auth()->guard()->name) {
        'admin' => route('patients.records', $patient->id),
        'doctor' => route('doctor.patients.records', $patient->id),
        'patient' => route('patient.records'),
    };
@endphp

<div class="card mt-3 mb-0 pb-0">
    <div class="card-body pl-0 mb-0">
        <h5 class="card-title mb-3">
            {{ __('general.words.records_timeline') }}
        </h5>
        <p class="card-subtitle mb-2 text-muted">
            {{ __('general.note.records_timeline') }}
        </p>
        <a href="{{ $route }}" class="btn btn-primary">
            {{ __('handle.show.') }}
        </a>
    </div>
</div>
