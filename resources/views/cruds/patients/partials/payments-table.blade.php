<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 text-md-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>{{ __('field.amount') }}</th>
                        <th>{{ __('field.notes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr class="text-center">
                            <td class="text-danger">$ {{ $payment->amount }}</td>
                            <td>{{ Str::limit($payment->notes, 50) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
