<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OPD Token Slip - #{{ $token->token_number }}</title>
    <style>
        body { font-family: monospace; width: 80mm; margin: 0 auto; padding: 10px; text-align: center; }
        .header { border-bottom: 2px dashed #000; padding-bottom: 5px; margin-bottom: 10px; }
        .token-no { font-size: 38px; font-weight: bold; margin: 10px 0; border: 2px solid #000; padding: 5px; }
        .details { text-align: left; font-size: 13px; line-height: 1.6; }
        .footer { border-top: 1px dashed #000; margin-top: 15px; padding-top: 5px; font-size: 11px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()">Print Slip</button>
    </div>
    <div class="header">
        <h2 style="margin: 0;">CITY HOSPITAL</h2>
        <p style="margin: 2px; font-size: 12px;">OPD CONSULTATION SLIP</p>
    </div>
    <div class="token-no">
        TOKEN #{{ $token->token_number }}
    </div>
    <div class="details">
        <div><strong>Date:</strong> {{ $token->token_date }}</div>
        <div><strong>Patient:</strong> {{ $token->patient->name ?? 'N/A' }}</div>
        <div><strong>UHID:</strong> {{ $token->patient->uhid ?? 'N/A' }}</div>
        <div><strong>Doctor:</strong> Dr. {{ $token->doctor->name ?? 'N/A' }}</div>
        <div><strong>Department:</strong> {{ $token->department->name ?? 'General' }}</div>
        <div><strong>Type:</strong> {{ strtoupper($token->token_type) }}</div>
        <div><strong>Fee Paid:</strong> ₹{{ number_format($token->consultation_fee, 2) }}</div>
    </div>
    <div class="footer">
        <p>Please wait for your token number to be announced.<br>Thank you for choosing City Hospital.</p>
    </div>
</body>
</html>
