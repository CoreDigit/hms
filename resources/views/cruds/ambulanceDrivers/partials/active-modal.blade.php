<div class="modal" id="ambulanceDrivers-activate-{{ $ambulanceDriver->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ $ambulanceDriver->name }}</h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h6>{{ __('general.warning.activate') }}</h6>
            </div>

            <div class="modal-footer">
                <form action="{{ route('ambulanceDrivers.activate', $ambulanceDriver->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button class="btn btn-success">{{ __('handle.activate') }}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                        type="button">{{ __('handle.close') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
