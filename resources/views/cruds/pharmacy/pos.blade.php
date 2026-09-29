@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Pharmacy POS Billing Terminal</h4>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<form action="{{ route('pharmacy.pos.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">Select Medicines for Sale</div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Search Medicine</label>
                        <select id="pos_med_select" class="form-control select2">
                            <option value="">-- Type to search medicine --</option>
                            @foreach($medicines as $m)
                                <option value="{{ $m->id }}" data-name="{{ $m->name }}" data-price="{{ $m->unit_price }}" data-stock="{{ $m->stock_quantity }}">
                                    {{ $m->name }} (Stock: {{ $m->stock_quantity }} | Price: ₹{{ $m->unit_price }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <table class="table table-bordered text-center" id="pos_cart_table">
                        <thead class="bg-light">
                            <tr>
                                <th>Medicine</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Total (₹)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-dark text-white">Bill Summary & Checkout</div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Registered Patient (Optional)</label>
                        <select name="patient_id" class="form-control select2">
                            <option value="">-- Walk-in Customer --</option>
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} (Phone: {{ $p->phone }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label>Customer Name (If Walk-in)</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Walk-in Customer Name">
                    </div>

                    <div class="form-group mb-2">
                        <label>Payment Mode</label>
                        <select name="payment_mode" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="card">Credit / Debit Card</option>
                            <option value="upi">UPI / Online</option>
                            <option value="insurance">Insurance Claim</option>
                        </select>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <strong id="cart_subtotal">₹0.00</strong>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Discount (₹)</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" name="discount_amount" id="cart_discount" class="form-control" value="0.00">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-sm-4 col-form-label">Tax (₹)</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" name="tax_amount" id="cart_tax" class="form-control" value="0.00">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between text-success tx-22 font-weight-bold my-3">
                        <span>Net Payable:</span>
                        <span id="cart_net_payable">₹0.00</span>
                    </div>

                    <button type="submit" class="btn btn-success btn-block btn-lg"><i class="fa fa-print"></i> Complete Sale & Print Invoice</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var itemIndex = 0;

    $('#pos_med_select').on('change', function() {
        var opt = $(this).find(':selected');
        var medId = opt.val();
        if(!medId) return;

        var name = opt.data('name');
        var price = parseFloat(opt.data('price'));
        var stock = parseInt(opt.data('stock'));

        // Check if already in cart
        var existingRow = $(`#pos_cart_table tbody tr[data-med-id="${medId}"]`);
        if(existingRow.length > 0) {
            var qtyInput = existingRow.find('.cart-qty');
            var curQty = parseInt(qtyInput.val()) + 1;
            if(curQty > stock) { alert('Stock limit reached!'); return; }
            qtyInput.val(curQty).trigger('input');
        } else {
            var html = `<tr data-med-id="${medId}">
                <td>
                    <b>${name}</b>
                    <input type="hidden" name="items[${itemIndex}][medicine_id]" value="${medId}">
                </td>
                <td>₹${price.toFixed(2)}</td>
                <td style="width:100px;">
                    <input type="number" name="items[${itemIndex}][quantity]" class="form-control cart-qty text-center" value="1" min="1" max="${stock}" data-price="${price}">
                </td>
                <td class="line-total font-weight-bold">₹${price.toFixed(2)}</td>
                <td><button type="button" class="btn btn-sm btn-danger remove-item"><i class="fa fa-trash"></i></button></td>
            </tr>`;
            $('#pos_cart_table tbody').append(html);
            itemIndex++;
        }

        $(this).val('').trigger('change');
        calculateTotals();
    });

    $(document).on('input', '.cart-qty', function() {
        var qty = parseInt($(this).val()) || 1;
        var price = parseFloat($(this).data('price'));
        var lineTotal = qty * price;
        $(this).closest('tr').find('.line-total').text('₹' + lineTotal.toFixed(2));
        calculateTotals();
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('tr').remove();
        calculateTotals();
    });

    $('#cart_discount, #cart_tax').on('input', function() {
        calculateTotals();
    });

    function calculateTotals() {
        var subtotal = 0;
        $('#pos_cart_table tbody tr').each(function() {
            var qty = parseInt($(this).find('.cart-qty').val()) || 0;
            var price = parseFloat($(this).find('.cart-qty').data('price')) || 0;
            subtotal += (qty * price);
        });

        var discount = parseFloat($('#cart_discount').val()) || 0;
        var tax = parseFloat($('#cart_tax').val()) || 0;

        var net = (subtotal - discount) + tax;

        $('#cart_subtotal').text('₹' + subtotal.toFixed(2));
        $('#cart_net_payable').text('₹' + net.toFixed(2));
    }
</script>
@endsection
