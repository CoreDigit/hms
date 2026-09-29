<div class="modal" id="ambulances-ambulanceDrivers-show-{{ $ambulance->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.ambulances') }} | {{ __('users.ambulanceDrivers') }}
                </h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-info mt-2">
                    <div class="card-header pb-0">
                        <h5 class="card-title text-info mb-0 pb-0">{{ __('users.ambulanceDrivers') }}</h5>
                    </div>
                    <div class="card-body">
                        @forelse ($ambulance->drivers as $driver)
                            <div>
                                <a href="{{ route('ambulanceDrivers.show', $driver->id) }}">
                                    {{ $driver->name }}
                                </a>
                            </div>
                        @empty
                            {{ __('general.warning.null') }}
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
