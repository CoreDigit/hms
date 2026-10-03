<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OPD Token Slip #{{ $token->token_number ?? $token->id }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; width: 148mm; margin: 0 auto; padding: 15px; background: #fff; }
        .header { text-align: center; border-bottom: 2px solid #1a73e8; padding-bottom: 10px; margin-bottom: 15px; }
        .title { font-size: 20px; font-weight: bold; color: #1a73e8; }
        .token-box { text-align: center; border: 2px dashed #1a73e8; padding: 15px; margin: 15px 0; background: #f4f8fd; border-radius: 8px; }
        .token-num { font-size: 36px; font-weight: bold; color: #1a73e8; }
        .info-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .info-table td { padding: 6px; border-bottom: 1px solid #eee; }
        .footer { margin-top: 30px; text-align: center; font-size: 11px; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px; text-align: center;">
        <button onclick="window.print()" style="padding: 8px 16px; font-size: 14px; cursor: pointer;">Print OPD Slip</button>
    </div>

    <div class="header">
        <div class="title">CITY HOSPITAL & MEDICAL CENTER</div>
        <div style="font-size: 12px; color: #555;">OPD Consultation Token Slip</div>
    </div>

    <div class="token-box">
        <div style="font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #555;">Token Number</div>
        <div class="token-num">#{{ $token->token_number ?? $token->id }}</div>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Patient Name:</strong> {{ $token->patient->name ?? 'N/A' }}</td>
            <td><strong>Age/Gender:</strong> {{ $token->patient->age ?? '-' }} / {{ ucfirst($token->patient->gender ?? '-') }}</td>
        </tr>
        <tr>
            <td><strong>Doctor Name:</strong> Dr. {{ $token->doctor->name ?? 'Consultant' }}</td>
            <td><strong>Department:</strong> {{ $token->department->name ?? 'General OPD' }}</td>
        </tr>
        <tr>
            <td><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($token->created_at)->format('d M Y h:i A') }}</td>
            <td><strong>Status:</strong> {{ ucfirst($token->status ?? 'pending') }}</td>
        </tr>
    </table>

    <div class="footer">
        Please wait for your token number to be called. Thank you!
    </div>
</body>
</html>
