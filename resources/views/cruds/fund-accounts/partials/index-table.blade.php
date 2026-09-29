<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th>{{ __('field.amount') }}</th>
                <th>{{ __('field.transaction.type') }}</th>
                <th>{{ __('const.case.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fundAccounts as $fundAccount)
                @php
                    switch ($fundAccount->case) {
                        case 'credit':
                            $color = 'success';
                            $sign = '+';
                            break;
                        case 'debit':
                            $color = 'danger';
                            $sign = '-';
                            break;
                    }
                    if ($fundAccount->amount == 0) {
                        $color = '';
                        $sign = '';
                    }
                @endphp

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>


                    <td class="text-{{ $color }}">
                        {{ $sign }} $ {{ $fundAccount->amount }}
                    </td>

                    <td title="{{ __('field.transaction.id') . ': ' . $fundAccount->transaction_id }}">
                        {{ __("cruds.$fundAccount->transaction_type.") }}
                    </td>

                    <td>
                        <span class="badge badge-pill badge-{{ $color }}">
                            {{ __("statistics.$fundAccount->case.") }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('fund-accounts.show', $fundAccount->id) }}" class="btn btn-sm btn-primary"
                            target="_blank" title="{{ __('handle.print') }}">
                            <i class="fas fa-print"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
