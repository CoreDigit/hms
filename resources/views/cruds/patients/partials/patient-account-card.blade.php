<div class="card mt-3 mb-0 pb-0">
    <div class="card-body pl-0 mb-0">
        <h5 class="card-title mb-3">{{ __('cruds.account.patient') }}</h5>
        <p class="card-subtitle mb-2 text-muted">{{ __('general.note.print_account') }}</p>
        <button data-toggle="modal" data-target="#patient-{{ $patient->id }}"
            class="btn btn-danger" title="{{ __('handle.print') }}">
            <i class="fas fa-print"></i> {{ __('handle.print') }}
        </button>    
        @include('cruds.patients.partials.auth-modal')
    </div>
</div>