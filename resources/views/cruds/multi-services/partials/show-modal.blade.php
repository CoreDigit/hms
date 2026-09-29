<div class="modal" id="multi-services-show-{{ $multiService->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ $multiService->name }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-warning">{{ __('field.description') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $multiService->description }}
                    </div>
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('statistics.total.before_discount') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $multiService->total_price }}
                    </div>
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('field.discount.value') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $multiService->discount_value }}
                    </div>
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('statistics.total.after_discount') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $multiService->getTotalAfterDiscount() }}
                    </div>
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('field.tax.rate') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $multiService->tax_rate }}
                    </div>
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('field.tax.value') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $multiService->getTaxValue() }}
                    </div>
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                        <strong class="text-info">{{ __('statistics.total.with_tax') }}: </strong>
                    </div>
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                        {{ $multiService->getTotalWithTax() }}
                    </div>
                </div>
                <div class="card card-info mt-2">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0 pb-0">{{ __('cruds.services.') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <strong class="text-info">{{ __('field.name') }}</strong>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-info">{{ __('field.quantity') }}</strong>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-info">{{ __('field.price') }}</strong>
                            </div>
                        </div>
                        @foreach ($multiService->singleServices as $singleService)
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    {{ $singleService->name }}
                                </div>
                                <div class="col-md-4">
                                    {{ $singleService->pivot->quantity }}
                                </div>
                                <div class="col-md-4">
                                    {{ $singleService->service->price }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
