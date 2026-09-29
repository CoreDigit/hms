<div class="modal" id="diagnostics-show-{{ $diagnostic->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.diagnostics') }} | {{ __('field.info') }}
                </h6>
                
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-warning">{{ __('field.notes') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $diagnostic->appointment->notes }}
                    </div>
                </div>

                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('field.diagnosis') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $diagnostic->diagnosis ?? __('general.warning.null') }}
                    </div>
                </div>

                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('field.medicines') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $diagnostic->medicines ?? __('general.warning.null') }}
                    </div>
                </div>

                @if ($diagnostic->re_diagnosis_date)
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <strong class="text-primary">{{ __('field.re_diagnosis_date') }}: </strong>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            {{ $diagnostic->re_diagnosis_date }}
                        </div>
                    </div>
                @endif

                @if ($diagnostic->lab->exists)
                    @php
                        $color = match ($diagnostic->lab->status) {
                            'pending' => 'danger',
                            'completed' => 'success',
                        };
                    @endphp

                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <strong class="text-danger">{{ __('const.status.redirecting.lab') }}: </strong>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <span class="badge badge-{{ $color }}">
                                {{ __('const.status.' . $diagnostic->lab->status) }}
                            </span>
                        </div>
                    </div>
                @endif

                @if ($diagnostic->ray->exists)
                    @php
                        $color = match ($diagnostic->ray->status) {
                            'pending' => 'danger',
                            'completed' => 'success',
                        };
                    @endphp

                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <strong class="text-danger">{{ __('const.status.redirecting.ray') }}: </strong>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <span class="badge badge-{{ $color }}">
                                {{ __('const.status.' . $diagnostic->ray->status) }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
