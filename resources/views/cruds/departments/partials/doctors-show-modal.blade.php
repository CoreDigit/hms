<div class="modal" id="departments-doctors-show-{{ $department->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.departments') }} | {{ __('users.doctors') }}
                </h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-info mt-2">
                    <div class="card-header pb-0">
                        <h5 class="card-title text-info mb-0 pb-0">{{ __('users.doctors') }}</h5>
                    </div>
                    <div class="card-body">
                        @forelse ($department->doctors as $doctor)
                            <div>
                                <a href="{{ route('doctors.show', $doctor->id) }}">
                                    {{ $doctor->name }}
                                </a>
                            </div>
                        @empty
                            {{ __('general.warning.no_doctors') }}
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
