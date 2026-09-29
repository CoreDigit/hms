<div class="card mt-3 mb-0 pb-0">
    <div class="card-body pl-0 mb-0">
        <h5 class="card-title mb-3">{{ __('handle.delete.account') }}</h5>
        <p class="card-subtitle mb-2 text-muted">{{ __('general.warning.delete_account.1') }}</p>
        <button data-toggle="modal" data-target="#rayEmployees-delete-{{ $rayEmployee->id }}"
            class="btn btn-danger" title="{{ __('handle.delete.') }}">
            {{ __('handle.delete.account') }}
        </button>
        @include('cruds.rayEmployees.partials.delete-modal')
    </div>
</div>