@switch($fundAccount->transaction_type)
    @case('receipt')
        @php
            $receipt = $fundAccount->transaction();
        @endphp
        @include('cruds.receipts.partials.receipt-table')
    @break

    @case('payment')
        @php
            $payment = $fundAccount->transaction();
        @endphp
        @include('cruds.payments.partials.payment-table')
    @break

    @case('invoice')
        @php
            $invoice = $fundAccount->transaction();
        @endphp
        @include('cruds.invoices.partials.invoice-table')
    @break
@endswitch
