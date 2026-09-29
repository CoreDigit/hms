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
            @foreach ($receipts as $receipt)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('patients.show', $receipt->patient->id) }}">{{ $receipt->patient->name }}</a>
                    </td>

                    <td class="text-success">
                        $ {{ $receipt->amount }}
                    </td>
                    <td title="{{ $receipt->notes }}">
                        {{ Str::limit($receipt->notes, 30) }}
                    </td>
                    
                    <td>
                        <a href="" data-toggle="modal" data-target="#receipts-edit-{{ $receipt->id }}"
                            class="btn btn-sm btn-info" title="{{ __('handle.edit') }}">
                            <i class="las la-pen"></i>
                        </a>

                        <a href="" data-toggle="modal" data-target="#receipts-auth-delete-{{ $receipt->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                            <i class="ti-trash"></i>
                        </a>

                        <a href="{{ route('receipts.show', $receipt->id) }}" class="btn btn-sm btn-primary"
                            target="_blank" title="{{ __('handle.print') }}">
                            <i class="fas fa-print"></i>
                        </a>
                    </td>
                </tr>
                @include('cruds.receipts.partials.edit-modal')
                @include('cruds.receipts.partials.auth-delete-modal')
            @endforeach
        </tbody>
    </table>
</div>
