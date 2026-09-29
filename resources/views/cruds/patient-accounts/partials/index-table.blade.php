<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                @if (auth()->guard('admin')->check())
                    <th>{{ __('users.patient') }}</th>
                @endif
                <th>{{ __('field.amount') }}</th>
                <th>{{ __('field.transaction.type') }}</th>
                <th>{{ __('const.case.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patientAccounts as $patientAccount)
                @php
                    switch ($patientAccount->case) {
                        case 'debit':
                            $color = 'success';
                            $sign = '+';
                            break;
                        case 'credit':
                            $color = 'danger';
                            $sign = '-';
                            break;
                    }
                    if ($patientAccount->amount == 0) {
                        $color = '';
                        $sign = '';
                    }
                    $route = match (auth()->guard()->name) {
                        'admin' => route('patient-accounts.show', $patientAccount->id),
                        'patient' => route('patient.accounts.show', $patientAccount->id),
                    };
                @endphp

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>

                    @if (auth()->guard('admin')->check())
                        <td>
                            <a href="{{ route('patients.show', $patientAccount->patient->id) }}">
                                {{ $patientAccount->patient->name }}
                            </a>
                        </td>
                    @endif

                    <td class="text-{{ $color }}">
                        {{ $sign }} $ {{ $patientAccount->amount }}
                    </td>

                    <td title="{{ __('field.transaction.id') . ': ' . $patientAccount->transaction_id }}">
                        {{ __("cruds.$patientAccount->transaction_type.") }}
                    </td>

                    <td>
                        <span class="badge badge-pill badge-{{ $color }}">
                            {{ __("statistics.$patientAccount->case.") }}
                        </span>
                    </td>

                    <td>
                        <a type="button" data-toggle="modal"
                            data-target="#patient-accounts-show-{{ $patientAccount->id }}" class="btn btn-sm btn-info"
                            title="{{ __('field.info') }}">
                            <i class="las la-info-circle"></i>
                        </a>

                        <a href="{{ $route }}" class="btn btn-sm btn-primary" target="_blank"
                            title="{{ __('handle.print') }}">
                            <i class="fas fa-print"></i>
                        </a>
                    </td>
                </tr>
                @include('cruds.patient-accounts.partials.show-modal')
            @endforeach
        </tbody>
    </table>
</div>
