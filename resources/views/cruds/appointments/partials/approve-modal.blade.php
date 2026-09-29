<div class="modal" id="appointments-approve-{{ $appointment->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.appointments') }} | {{ __('const.status.approval') }}
                </h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.appointments.approve', $appointment->id)}}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('field.time') }}</label>
                            <input type="time" name="time" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary">{{ __('handle.schedule') }}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                        {{ __('handle.close') }}
                    </button>                
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
