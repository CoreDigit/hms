<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-md-nowrap">
                <tbody>
                    <tr>
                        <th scope="row">{{ __('statistics.total.credit') }}:</th>
                        <td class="text-success">{{ $totalCredit }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('statistics.total.debit') }}:</th>
                        <td class="text-danger">{{ $totalDebit }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('general.words.difference') }}:</th>
                        @php
                            $diff = $totalCredit - $totalDebit;
                            $textColor = $diff < 0 ? 'danger' : 'success';
                        @endphp
                        <td class="text-{{ $textColor }}">{{ $diff }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
