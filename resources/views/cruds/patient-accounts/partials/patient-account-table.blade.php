@switch($patientAccount->transaction_type)
    @case('receipt')
        @php
            $receipt = $patientAccount->transaction();
        @endphp
        @include('cruds.receipts.partials.receipt-table')
    @break

    @case('payment')
        @php
            $payment = $patientAccount->transaction();
        @endphp
        @include('cruds.payments.partials.payment-table')
    @break

    @case('invoice')
        @php
            $invoice = $patientAccount->transaction();
        @endphp
        @include('cruds.invoices.partials.invoice-table')
    @break
@endswitch
