<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discharge Summary #{{ $summary->id }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; width: 210mm; margin: 0 auto; padding: 20px; background: #fff; }
        .header { text-align: center; border-bottom: 2px solid #0077b6; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; color: #0077b6; }
        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 14px; }
        .meta-table td { padding: 6px; border-bottom: 1px solid #eee; }
        .section-title { font-size: 16px; font-weight: bold; color: #0077b6; margin-top: 15px; border-bottom: 1px solid #0077b6; padding-bottom: 4px; }
        .section-content { font-size: 14px; line-height: 1.6; margin-top: 8px; color: #333; }
        .footer { margin-top: 60px; display: flex; justify-content: space-between; font-size: 13px; border-top: 1px solid #ddd; padding-top: 15px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Print Discharge Summary</button>
    </div>

    <div class="header">
        <div class="title">CITY HOSPITAL & MEDICAL CENTER</div>
        <div style="font-size: 13px; color: #555;">IPD Patient Discharge Summary</div>
    </div>

    <table class="meta-table">
        <tr>
            <td><strong>Patient Name:</strong> {{ $summary->patient->name ?? ($summary->admission->patient->name ?? 'N/A') }}</td>
            <td><strong>UHID / Admission ID:</strong> {{ $summary->admission->id ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Admission Date:</strong> {{ \Carbon\Carbon::parse($summary->admission_date ?? $summary->created_at)->format('d M Y') }}</td>
            <td><strong>Discharge Date:</strong> {{ \Carbon\Carbon::parse($summary->discharge_date ?? now())->format('d M Y') }}</td>
        </tr>
        <tr>
            <td><strong>Attending Doctor:</strong> Dr. {{ $summary->doctor->name ?? 'Consultant' }}</td>
            <td><strong>Discharge Status:</strong> {{ ucfirst($summary->discharge_status ?? 'Cured / Discharged') }}</td>
        </tr>
    </table>

    <div class="section-title">Final Diagnosis</div>
    <div class="section-content">{{ $summary->final_diagnosis ?? 'As per clinical evaluation.' }}</div>

    <div class="section-title">Admission Complaints & History</div>
    <div class="section-content">{{ $summary->complaints_history ?? 'Patient was admitted for further evaluation and management.' }}</div>

    <div class="section-title">Treatment Given & Course in Hospital</div>
    <div class="section-content">{{ $summary->treatment_summary ?? 'Conservative medical management was provided during IPD stay.' }}</div>

    <div class="section-title">Advice on Discharge</div>
    <div class="section-content">{{ $summary->discharge_advice ?? 'Continue prescribed medications and rest.' }}</div>

    @if($summary->follow_up_date)
        <div class="section-title">Follow-up Visit Date</div>
        <div class="section-content"><strong>{{ \Carbon\Carbon::parse($summary->follow_up_date)->format('d M Y') }}</strong></div>
    @endif

    <div class="footer">
        <div>Resident Doctor Signature: __________________</div>
        <div>Consultant Signature: __________________</div>
    </div>
</body>
</html>
