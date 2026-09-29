<div class="modal" id="rays-show-{{ $ray->id }}">
    <div class="modal-dialog modal-dialog-scrolrayle" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.rays') }} | {{ __('field.info') }}
                </h6>
                <button aria-rayel="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-warning">{{ __('field.description') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $ray->description ?? __('general.warning.null') }}
                    </div>
                </div>

                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('field.diagnosis') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $ray->diagnosis ?? __('general.warning.null') }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
