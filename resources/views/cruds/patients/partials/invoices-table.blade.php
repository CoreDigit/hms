<div class="card">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-center">
            <h4 class="card-title mg-b-0">
                {{ __('cruds.services.single') }}
            </h4>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 text-md-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>{{ __('users.doctor') }}</th>
                        <th>{{ __('cruds.service.') }}</th>
                        <th>{{ __('field.price') }}</th>
                        <th>{{ __('const.case.') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($singleServiceInvoices as $invoice)
                        <tr class="text-center">
                            <td>
                                <a href="{{ route('doctors.show', $invoice->doctor->id) }}">
                                    {{ $invoice->doctor->name }}
                                </a>
                            </td>
                            <td>{{ $invoice->service->name }}</td>
                            <td>$ {{ $invoice->service->price }}</td>
                            <td>
                                @if ($invoice->case === 'paid')
                                    <span
                                        class="text-center text-success">{{ __('const.case.paid') }}</span>
                                @else
                                    <span
                                        class="text-center text-danger">{{ __('const.case.pending') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<hr>

<div class="card">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-center">
            <h4 class="card-title mg-b-0">
                {{ __('cruds.services.multi') }}
            </h4>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 text-md-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>{{ __('users.doctor') }}</th>
                        <th>{{ __('cruds.service.') }}</th>
                        <th>{{ __('field.price') }}</th>
                        <th>{{ __('const.case.') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($multiServiceInvoices as $invoice)
                        <tr class="text-center">
                            <td>
                                <a href="{{ route('doctors.show', $invoice->doctor->id) }}">
                                    {{ $invoice->doctor->name }}
                                </a>
                            </td>
                            <td>{{ $invoice->service->name }}</td>
                            <td>$ {{ $invoice->service->price }}</td>
                            <td>
                                @if ($invoice->case === 'paid')
                                    <span
                                        class="text-center text-success">{{ __('const.case.paid') }}</span>
                                @else
                                    <span
                                        class="text-center text-danger">{{ __('const.case.pending') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
