<div class="modal" id="departments-show-{{ $department->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ $department->name ?? __('general.warning.no_translation') }}
                </h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-warning">{{ __('field.description') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $department->description ?? __('general.warning.no_translation') }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
