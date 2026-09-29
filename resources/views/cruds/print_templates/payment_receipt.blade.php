<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt #REC-{{ $payment->id }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; width: 210mm; margin: 0 auto; padding: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #0077b6; padding-bottom: 10px; margin-bottom: 20px; }
        .hospital-title { font-size: 24px; font-weight: bold; color: #0077b6; }
        .table-info { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table-info td { padding: 8px; border-bottom: 1px solid #eee; font-size: 14px; }
        .amount-box { border: 2px solid #0077b6; background: #f0f8ff; padding: 15px; text-align: center; border-radius: 8px; margin: 20px 0; }
        .amount-val { font-size: 26px; font-weight: bold; color: #0077b6; }
        .footer { margin-top: 50px; display: flex; justify-content: space-between; font-size: 13px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Print Payment Receipt</button>
    </div>

    <div class="header">
        <div class="hospital-title">CITY HOSPITAL & MEDICAL CENTER</div>
        <div>OFFICIAL PAYMENT ACKNOWLEDGEMENT RECEIPT</div>
    </div>

    <table class="table-info">
        <tr>
            <td><strong>Receipt No:</strong> #REC-{{ $payment->id }}</td>
            <td><strong>Date:</strong> {{ Carbon\Carbon::parse($payment->created_at)->format('d M Y h:i A') }}</td>
        </tr>
        <tr>
            <td><strong>Received From Patient:</strong> {{ $payment->patient->name ?? 'N/A' }}</td>
            <td><strong>UHID:</strong> {{ $payment->patient->uhid ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="amount-box">
        <div>AMOUNT RECEIVED</div>
        <div class="amount-val">₹{{ number_format($payment->amount, 2) }}</div>
    </div>

    <div class="footer">
        <div>
            Received By: Cashier / Accountant<br>
            Thank you!
        </div>
        <div style="text-align: right;">
            _______________________<br>
            Authorized Signature
        </div>
    </div>
</body>
</html>
