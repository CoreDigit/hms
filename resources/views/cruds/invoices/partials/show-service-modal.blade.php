<div class="modal" id="invoice-service-show-{{ $loop->iteration }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ $invoice->service->name }}</h6>

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
                        {{ $invoice->service->description }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if ($invoice->service->type == 'multi')
                    <a href="{{ route('multi-services.index') }}" class="btn btn-primary">
                        <i class="las la-eye"></i> &nbsp;&nbsp; {{ __('handle.show.more') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
