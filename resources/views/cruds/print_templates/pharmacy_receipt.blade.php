<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharmacy Receipt #{{ $invoice->invoice_number ?? $invoice->id }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; width: 148mm; margin: 0 auto; padding: 15px; background: #fff; }
        .header { text-align: center; border-bottom: 2px solid #28a745; padding-bottom: 10px; margin-bottom: 15px; }
        .title { font-size: 20px; font-weight: bold; color: #28a745; }
        .meta-table, .items-table { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 15px; }
        .meta-table td { padding: 4px; }
        .items-table th, .items-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .items-table th { background: #f8f9fa; }
        .total-row { font-weight: bold; background: #e9ecef; }
        .footer { margin-top: 20px; text-align: center; font-size: 11px; color: #666; border-top: 1px solid #eee; padding-top: 10px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px; text-align: center;">
        <button onclick="window.print()" style="padding: 8px 16px; font-size: 14px; cursor: pointer;">Print Pharmacy Receipt</button>
    </div>

    <div class="header">
        <div class="title">CITY HOSPITAL PHARMACY</div>
        <div style="font-size: 12px; color: #555;">Official Bill & Payment Receipt</div>
    </div>

    <table class="meta-table">
        <tr>
            <td><strong>Invoice No:</strong> #{{ $invoice->invoice_number ?? $invoice->id }}</td>
            <td><strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y h:i A') }}</td>
        </tr>
        <tr>
            <td><strong>Patient Name:</strong> {{ $invoice->patient->name ?? 'Walk-in Customer' }}</td>
            <td><strong>Payment Status:</strong> {{ ucfirst($invoice->payment_status ?? 'paid') }}</td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Item / Medicine</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoice->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->medicine->name ?? ($item->medicine_name ?? 'Item') }}</td>
                    <td>{{ $item->quantity ?? 1 }}</td>
                    <td>₹{{ number_format($item->unit_price ?? $item->price ?? 0, 2) }}</td>
                    <td>₹{{ number_format(($item->quantity ?? 1) * ($item->unit_price ?? $item->price ?? 0), 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No items found.</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="4" style="text-align: right;">Total Amount Paid:</td>
                <td>₹{{ number_format($invoice->total_amount ?? $invoice->net_amount ?? 0, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Thank you for choosing City Hospital Pharmacy. Get well soon!
    </div>
</body>
</html>
