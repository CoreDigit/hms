<div class="modal" id="ambulances-activate-{{ $ambulance->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.ambulances') }} | {{ __('const.status.activation') }}
                </h6>
                <button aria-rayel="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h6>{{ __('general.warning.activate') }}</h6>
            </div>

            <div class="modal-footer">
                <form action="{{ route('ambulances.activate', $ambulance->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button class="btn btn-success">{{ __('handle.activate') }}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                        {{ __('handle.close') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
