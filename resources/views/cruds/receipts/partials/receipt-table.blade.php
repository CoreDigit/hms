<table class="table table-invoice border text-md-nowrap mb-0">
    <tbody>
        <tr>
            <td class="valign-middle" colspan="2" rowspan="4">
                <h3>{{ __('cruds.receipt.') }}</h3>
                <div class="invoice-notes">
                    <label class="main-content-label tx-13">{{ __('field.notes') }}</label>
                    <p>{{ $receipt->notes }}</p>
                </div>
            </td>
            <td class="tx-right tx-uppercase tx-bold tx-inverse"></td>
            <td class="tx-right" colspan="2"></td>
        </tr>
        <tr>
            <td class="tx-right"></td>
            <td class="tx-right" colspan="2"></td>
        </tr>
        <tr>
            <td class="tx-right"></td>
            <td class="tx-right" colspan="2"></td>
        </tr>
        <tr>
            <td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('field.price') }}</td>
            <td class="tx-right" colspan="2">
                <h4 class="tx-primary tx-bold">${{ $receipt->amount }}</h4>
            </td>
        </tr>
    </tbody>
</table>