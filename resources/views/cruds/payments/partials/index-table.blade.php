<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th>{{ __('users.patient') }}</th>
                <th>{{ __('field.amount') }}</th>
                <th>{{ __('field.notes') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('patients.show', $payment->patient->id) }}">{{ $payment->patient->name }}</a>
                    </td>
                    
                    <td class="text-danger">
                        $ {{ $payment->amount }}
                    </td>
                    <td title="{{ $payment->notes }}">
                        {{ Str::limit($payment->notes, 30) }}
                    </td>
                    
                    <td>
                        <a href="" data-toggle="modal" data-target="#payments-edit-{{ $payment->id }}"
                            class="btn btn-sm btn-info" title="{{ __('handle.edit') }}">
                            <i class="las la-pen"></i>
                        </a>

                        <a href="" data-toggle="modal" data-target="#payments-auth-delete-{{ $payment->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                            <i class="ti-trash"></i>
                        </a>

                        <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-primary"
                            target="_blank" title="{{ __('handle.print') }}">
                            <i class="fas fa-print"></i>
                        </a>
                    </td>
                </tr>
                @include('cruds.payments.partials.edit-modal')
                @include('cruds.payments.partials.auth-delete-modal')
            @endforeach
        </tbody>
    </table>
</div>
