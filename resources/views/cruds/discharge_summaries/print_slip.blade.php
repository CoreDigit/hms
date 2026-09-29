<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discharge Summary - #DS-{{ $summary->id }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; width: 210mm; margin: 0 auto; padding: 20px; color: #333; }
        .header { text-align: center; border-bottom: 3px double #0077b6; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; color: #0077b6; margin: 0; }
        .sub-title { font-size: 16px; font-weight: bold; margin-top: 5px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd; }
        .info-table td { padding: 8px; border: 1px solid #ddd; font-size: 13px; }
        .section-header { background: #f0f4f8; font-weight: bold; padding: 6px; font-size: 14px; margin-top: 15px; border-left: 4px solid #0077b6; }
        .section-content { padding: 10px; font-size: 13px; line-height: 1.6; white-space: pre-line; }
        .footer { margin-top: 60px; display: flex; justify-content: space-between; font-size: 13px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Print Summary</button>
    </div>

    <div class="header">
        <div class="title">CITY HOSPITAL & RESEARCH CENTER</div>
        <div class="sub-title">PATIENT DISCHARGE SUMMARY & MEDICAL CERTIFICATE</div>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Patient Name:</strong> {{ $summary->patient->name ?? 'N/A' }}</td>
            <td><strong>UHID:</strong> {{ $summary->patient->uhid ?? 'N/A' }}</td>
            <td><strong>Age/Gender:</strong> {{ $summary->patient->age ?? '-' }} Yrs / {{ ucfirst($summary->patient->gender ?? '-') }}</td>
        </tr>
        <tr>
            <td><strong>Admission Date:</strong> {{ $summary->admission ? Carbon\Carbon::parse($summary->admission->admission_date)->format('d M Y h:i A') : 'N/A' }}</td>
            <td><strong>Discharge Date:</strong> {{ Carbon\Carbon::parse($summary->discharge_date)->format('d M Y') }}</td>
            <td><strong>Discharge Type:</strong> {{ strtoupper($summary->discharge_type) }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Attending Consultant:</strong> Dr. {{ $summary->doctor->name ?? 'N/A' }}</td>
            <td><strong>Ward / Bed:</strong> {{ $summary->admission->ward->name ?? 'Ward' }} / Bed #{{ $summary->admission->bed->bed_number ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-header">FINAL DIAGNOSIS</div>
    <div class="section-content"><strong>{{ $summary->final_diagnosis }}</strong></div>

    <div class="section-header">REASON FOR ADMISSION</div>
    <div class="section-content">{{ $summary->admission_reason ?? 'N/A' }}</div>

    <div class="section-header">TREATMENT ADMINISTERED & COURSE IN HOSPITAL</div>
    <div class="section-content">{{ $summary->treatment_summary ?? 'N/A' }}</div>

    <div class="section-header">CONDITION AT DISCHARGE</div>
    <div class="section-content">{{ $summary->discharge_condition ?? 'Stable and satisfactory' }}</div>

    <div class="section-header">POST-DISCHARGE MEDICATIONS (TAKE HOME)</div>
    <div class="section-content">{{ $summary->discharge_medications ?? 'None' }}</div>

    <div class="section-header">ADVICE & FOLLOW-UP</div>
    <div class="section-content">
        {{ $summary->advice_instructions ?? 'N/A' }}
        @if($summary->follow_up_date)
            <br><strong>Follow Up Visit:</strong> {{ Carbon\Carbon::parse($summary->follow_up_date)->format('d M Y') }}
        @endif
    </div>

    <div class="footer">
        <div>
            Prepared By: Staff Nurse / Resident<br>
            Date: {{ date('d M Y') }}
        </div>
        <div style="text-align: right;">
            _______________________<br>
            Dr. {{ $summary->doctor->name ?? 'Consultant' }}<br>
            (Consultant Physician / Surgeon)
        </div>
    </div>
</body>
</html>
