<div class="modal" id="appointments-refuse-{{ $appointment->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.appointments') }} | {{ __('const.status.refusal') }}
                </h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>{{ __('general.warning.refuse') }}</h6>
            </div>
            <div class="modal-footer">
                <form action="{{ route('doctor.appointments.refuse', $appointment->id)}}" method="post">
                    @method('PUT')
                    @csrf
    
                    <button class="btn btn-danger">{{ __('handle.refuse') }}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                        {{ __('handle.close') }}
                    </button>                
                </form>
            </div>
        </div>
    </div>
</div>
