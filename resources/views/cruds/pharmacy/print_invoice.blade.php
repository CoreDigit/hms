<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharmacy Receipt #{{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: monospace; width: 80mm; margin: 0 auto; padding: 10px; font-size: 12px; }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 5px; margin-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; margin: 0; }
        .item-table { width: 100%; border-collapse: collapse; margin-top: 10px; text-align: left; }
        .item-table th, .item-table td { padding: 4px 0; border-bottom: 1px dashed #ccc; }
        .totals { margin-top: 10px; border-top: 2px dashed #000; padding-top: 5px; text-align: right; }
        .footer { text-align: center; margin-top: 15px; border-top: 1px dashed #000; padding-top: 5px; font-size: 10px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 10px; text-align: center;">
        <button onclick="window.print()">Print Receipt</button>
    </div>

    <div class="header">
        <div class="title">CITY PHARMACY</div>
        <div>Hospital Ground Floor | License #PH-2026-99</div>
        <div>Invoice: <strong>{{ $invoice->invoice_number }}</strong></div>
        <div>Date: {{ Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y H:i') }}</div>
        <div>Customer: {{ $invoice->customer_name }}</div>
    </div>

    <table class="item-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th style="text-align:right;">Amt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->medicine_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td style="text-align:right;">{{ number_format($item->total_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div>Subtotal: ₹{{ number_format($invoice->total_amount, 2) }}</div>
        <div>Discount: ₹{{ number_format($invoice->discount_amount, 2) }}</div>
        <div>Tax: ₹{{ number_format($invoice->tax_amount, 2) }}</div>
        <div style="font-size: 14px; font-weight: bold; margin-top: 5px;">NET TOTAL: ₹{{ number_format($invoice->net_amount, 2) }}</div>
        <div>Payment Mode: {{ strtoupper($invoice->payment_mode) }} (PAID)</div>
    </div>

    <div class="footer">
        Thank you for choosing City Pharmacy!<br>
        Medicines once sold cannot be returned without original receipt.
    </div>
</body>
</html>
