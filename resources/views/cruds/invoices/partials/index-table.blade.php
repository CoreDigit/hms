<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th>{{ __('cruds.service.name') }}</th>
                <th>{{ __('cruds.service.type') }}</th>
                <th>{{ __('field.price') }}</th>
                <th>{{ __('users.patient') }}</th>
                <th>{{ __('users.doctor') }}</th>
                <th>{{ __('const.case.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                @php
                    $color = match ($invoice->case) {
                        'pending' => 'danger',
                        'paid' => 'success',
                    };
                @endphp

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <a href="" data-toggle="modal" data-target="#invoice-service-show-{{ $loop->iteration }}">
                            {{ $invoice->service->name }}
                        </a>
                    </td>

                    <td class="text-{{ $invoice->service->type == 'single' ?: 'rainbow'}}">
                        {{ $invoice->service->type }}
                    </td>

                    <td class='text-{{ $color }}'>$ {{ $invoice->service->price }}</td>

                    <td>
                        <a href="{{ route('patients.show', $invoice->patient->id) }}">{{ $invoice->patient->name }}</a>
                    </td>
                    <td>
                        <a href="{{ route('doctors.show', $invoice->doctor->id) }}">{{ $invoice->doctor->name }}</a>
                    </td>

                    <td>
                        <span class="badge badge-pill badge-{{ $color }}">
                            {{ __("const.case.$invoice->case") }}
                        </span>
                    </td>

                    <td>
                        <a href="" data-toggle="modal" data-target="#invoices-edit-{{ $invoice->id }}"
                            class="btn btn-sm btn-info" title="{{ __('handle.edit') }}"><i class="las la-pen"></i></a>

                        <a href="" data-toggle="modal" data-target="#invoices-auth-delete-{{ $invoice->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}"><i class="ti-trash"></i></a>

                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary"
                            target="_blank" title="{{ __('handle.print') }}">
                            <i class="fas fa-print"></i>
                        </a>
                    </td>
                </tr>
                @include('cruds.invoices.partials.edit-modal')
                @include('cruds.invoices.partials.auth-delete-modal')
                @include('cruds.invoices.partials.show-service-modal')
            @endforeach
        </tbody>
    </table>
</div>
