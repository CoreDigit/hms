<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescription Rx #{{ $prescription->id }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; width: 210mm; margin: 0 auto; padding: 20px; background: #fff; }
        .header { display: flex; justify-content: space-between; border-bottom: 2px solid #0077b6; padding-bottom: 10px; margin-bottom: 20px; }
        .hospital-name { font-size: 26px; font-weight: bold; color: #0077b6; }
        .rx-symbol { font-size: 30px; font-weight: bold; font-family: serif; color: #0077b6; }
        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 14px; }
        .meta-table td { padding: 6px; border-bottom: 1px solid #eee; }
        .med-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .med-table th, .med-table td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 14px; }
        .med-table th { background: #f4f6f9; }
        .footer { margin-top: 50px; display: flex; justify-content: space-between; font-size: 13px; border-top: 1px solid #ddd; padding-top: 15px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Print Prescription</button>
    </div>

    <div class="header">
        <div>
            <div class="hospital-name">CITY HOSPITAL & MEDICAL CENTER</div>
            <div>123 Healthcare Boulevard, Medical City | Emergency: +91 9876543210</div>
        </div>
        <div style="text-align: right;">
            <div style="font-size: 18px; font-weight: bold;">Dr. {{ $prescription->doctor->name ?? 'Doctor' }}</div>
            <div>{{ $prescription->doctor->department->name ?? 'Specialist Consultant' }}</div>
        </div>
    </div>

    <table class="meta-table">
        <tr>
            <td><strong>Patient Name:</strong> {{ $prescription->patient->name ?? 'N/A' }}</td>
            <td><strong>Age/Gender:</strong> {{ $prescription->patient->age ?? '-' }} Yrs / {{ ucfirst($prescription->patient->gender ?? '-') }}</td>
            <td><strong>UHID:</strong> {{ $prescription->patient->uhid ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Date:</strong> {{ Carbon\Carbon::parse($prescription->prescription_date)->format('d M Y') }}</td>
            <td colspan="2"><strong>Diagnosis:</strong> {{ $prescription->diagnosis }}</td>
        </tr>
    </table>

    <div class="rx-symbol">Rx</div>

    <table class="med-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Medicine Name</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Duration</th>
                <th>Instructions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prescription->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $item->medicine_name }}</strong></td>
                    <td>{{ $item->dosage }}</td>
                    <td>{{ $item->frequency }}</td>
                    <td>{{ $item->duration }}</td>
                    <td>{{ $item->instructions }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($prescription->advice)
        <div style="margin-top: 20px;">
            <strong>Advice / Diet Instructions:</strong>
            <p style="margin: 5px 0;">{{ $prescription->advice }}</p>
        </div>
    @endif

    @if($prescription->follow_up_date)
        <div style="margin-top: 15px;">
            <strong>Follow-Up Date:</strong> {{ Carbon\Carbon::parse($prescription->follow_up_date)->format('d M Y') }}
        </div>
    @endif

    <div class="footer">
        <div>Substitute with equivalent generic medicine permitted if required.</div>
        <div style="text-align: right;">
            <br><br>
            _______________________<br>
            Doctor's Signature & Stamp
        </div>
    </div>
</body>
</html>
