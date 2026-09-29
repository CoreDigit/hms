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
                    @foreach ($receipts as $receipt)
                        <tr class="text-center">
                            <td class="text-success">$ {{ $receipt->amount }}</td>
                            <td>{{ Str::limit($receipt->notes, 50) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
