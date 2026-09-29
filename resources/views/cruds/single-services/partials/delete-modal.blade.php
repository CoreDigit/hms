<div class="modal" id="single-services-delete-{{ $singleService->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ $singleService->name }}</h6>

                <button aria-rayel="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h6>{{ __('general.warning.delete') }}</h6>
            </div>

            <div class="modal-footer">
                <form action="{{ route('single-services.destroy', $singleService->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">{{ __('handle.delete.') }}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                        type="button">{{ __('handle.close') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
