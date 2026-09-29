@if ($invoice->service->type === 'multi')
    @php
        $multiService = $invoice->service->multiService;
        $singleServices = $multiService->singleServices;
    @endphp
    <table class="table table-invoice border text-md-nowrap mb-0">
        <thead class="text-center">
            <tr>
                <th class="wd-20p">#</th>
                <th>{{ __('cruds.service.') }}</th>
                <th>{{ __('field.quantity') }}</th>
                <th>{{ __('field.price') }}</th>
                <th>{{ __('field.amount') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($singleServices as $singleService)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $singleService->name }}</td>
                    <td>{{ $singleService->pivot->quantity }}</td>
                    <td>{{ $singleService->service->price }}</td>
                    <td>{{ $singleService->pivot->quantity * $singleService->service->price }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="valign-middle" colspan="2" rowspan="4">
                    <h3>{{ __('cruds.service.multi') }}</h3>
                    <div class="invoice-notes">
                        <label class="main-content-label tx-13">{{ __('field.name') }}</label>
                        <p>{{ $multiService->name }}</p>
                    </div>
                    <div class="invoice-notes">
                        <label class="main-content-label tx-13">{{ __('field.description') }}</label>
                        <p>{{ $multiService->description }}</p>
                    </div>
                </td>
                <td class="tx-right">{{ __('statistics.total.price') }}</td>
                <td class="tx-right" colspan="2">$ {{ $multiService->total_price }}</td>
            </tr>
            <tr>
                <td class="tx-right">{{ __('field.discount.value') }}</td>
                <td class="tx-right" colspan="2">$ {{ $multiService->discount_value }}</td>
            </tr>
            <tr>
                <td class="tx-right">{{ __('field.tax.rate') }}</td>
                <td class="tx-right" colspan="2">% {{ $multiService->tax_rate }}</td>
            </tr>
            <tr>
                <td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('statistics.total.due') }}</td>
                <td class="tx-right" colspan="2">
                    <h4 class="tx-primary tx-bold">$ {{ $invoice->service->price }}</h4>
                </td>
            </tr>
        </tbody>
    </table>
@else
    @php
        $singleService = $invoice->service->singleService;
    @endphp
    <table class="table table-invoice border text-md-nowrap mb-0">
        <tbody>
            <tr>
                <td class="valign-middle" colspan="2" rowspan="4">
                    <h3>{{ __('cruds.service.single') }}</h3>
                    <div class="invoice-notes">
                        <label class="main-content-label tx-13">{{ __('field.name') }}</label>
                        <p>{{ $singleService->name }}</p>
                    </div>
                    <div class="invoice-notes">
                        <label class="main-content-label tx-13">{{ __('field.description') }}</label>
                        <p>{{ $singleService->description }}</p>
                    </div>
                </td>
                <td class="tx-right tx-uppercase tx-bold tx-inverse"></td>
                <td class="tx-right" colspan="2"></td>
            </tr>
            <tr>
                <td class="tx-right"></td>
                <td class="tx-right" colspan="2"></td>
            </tr>
            <tr>
                <td class="tx-right"></td>
                <td class="tx-right" colspan="2"></td>
            </tr>
            <tr>
                <td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('field.price') }}</td>
                <td class="tx-right" colspan="2">
                    <h4 class="tx-primary tx-bold">${{ $singleService->service->price }}</h4>
                </td>
            </tr>
        </tbody>
    </table>
@endif
