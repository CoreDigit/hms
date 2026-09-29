<div class="modal" id="patient-accounts-show-{{ $patientAccount->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.account.patient') }} | {{ __('field.info') }}
                </h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @if ($patientAccount->transaction_type == 'invoice')
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <strong class="text-warning">{{ __('cruds.service.') }}: </strong>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            {{ $patientAccount->transaction()->service->name }}
                        </div>
                    </div>
                @else
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <strong class="text-warning">{{ __('field.notes') }}: </strong>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            {{ $patientAccount->transaction()->notes }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
