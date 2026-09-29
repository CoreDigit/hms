<div class="modal" id="delete-group">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.insurances') }} | {{ __('handle.delete.group') }}
                </h6>

                <button aria-rayel="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h6>{{ __('general.warning.delete_group') }}</h6>
            </div>

            <div class="modal-footer">
                <form action="{{ route('insurances.destroy-group') }}" method="POST">
                    @csrf

                    <input type="hidden" id="ids" name="selector_ids">

                    <button class="btn btn-danger">{{ __('handle.delete.') }}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                        type="button">{{ __('handle.close') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
