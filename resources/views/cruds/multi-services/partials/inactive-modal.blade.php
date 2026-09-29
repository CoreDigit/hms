<div class="modal" id="multi-services-inactivate-{{ $multiService->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ $multiService->name }}</h6>

                <button aria-rayel="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h6>{{ __('general.warning.inactivate') }}</h6>
            </div>

            <div class="modal-footer">
                <form action="{{ route('multi-services.inactivate', $multiService->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button class="btn btn-danger">{{ __('handle.inactivate') }}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                        type="button">{{ __('handle.close') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
