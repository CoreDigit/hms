<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient ID Card - {{ $patient->name }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #eee; padding: 20px; display: flex; justify-content: center; }
        .id-card { width: 86mm; height: 54mm; background: linear-gradient(135deg, #0077b6, #023e8a); color: #fff; border-radius: 10px; padding: 12px; box-sizing: border-box; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        .hospital-header { font-size: 13px; font-weight: bold; border-bottom: 1px solid #48cae4; padding-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px; }
        .body-content { display: flex; margin-top: 8px; }
        .avatar-box { width: 50px; height: 50px; background: #fff; border-radius: 6px; overflow: hidden; margin-right: 10px; border: 2px solid #48cae4; text-align: center; line-height: 50px; color: #0077b6; font-weight: bold; font-size: 20px; }
        .patient-details { font-size: 11px; line-height: 1.4; }
        .patient-name { font-size: 14px; font-weight: bold; color: #caf0f8; }
        .uhid-badge { background: #48cae4; color: #03045e; font-weight: bold; font-size: 10px; padding: 2px 6px; border-radius: 4px; display: inline-block; margin-top: 3px; }
        .footer-line { position: absolute; bottom: 8px; left: 12px; right: 12px; font-size: 9px; color: #caf0f8; display: flex; justify-content: space-between; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 3px; }
        @media print { body { background: #fff; padding: 0; } .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div>
        <div class="no-print" style="margin-bottom: 15px; text-align: center;">
            <button onclick="window.print()" style="padding: 8px 16px; cursor: pointer;">Print Patient ID Card</button>
        </div>

        <div class="id-card">
            <div class="hospital-header">
                CITY HOSPITAL & HEALTHCARE
            </div>
            <div class="body-content">
                <div class="avatar-box">
                    @if($patient->photo)
                        <img src="{{ asset('storage/' . $patient->photo) }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        {{ strtoupper(substr($patient->name, 0, 1)) }}
                    @endif
                </div>
                <div class="patient-details">
                    <div class="patient-name">{{ $patient->name }}</div>
                    <div>UHID: <strong>{{ $patient->uhid ?? ('PAT-' . $patient->id) }}</strong></div>
                    <div>Age/Gender: {{ $patient->age ?? '-' }} Yrs / {{ ucfirst($patient->gender ?? '-') }}</div>
                    <div>Phone: {{ $patient->phone }}</div>
                    @if($patient->allergies)
                        <div style="color:#ffb703; font-weight:bold; font-size:9px;">Allergies: {{ $patient->allergies }}</div>
                    @endif
                </div>
            </div>
            <div class="footer-line">
                <span>Emergency: {{ $patient->emergency_contact_phone ?? '108' }}</span>
                <span>Hospital Helpline: +91 9876543210</span>
            </div>
        </div>
    </div>
</body>
</html>
