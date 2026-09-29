<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPD Live Queue Board - Hospital Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="refresh" content="10">
    <style>
        body { background-color: #0b132b; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .queue-header { background-color: #1c2541; padding: 20px; text-align: center; border-bottom: 3px solid #48cae4; }
        .token-card { background: #1c2541; border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        .current-token { background: linear-gradient(135deg, #0077b6, #023e8a); border: 2px solid #00b4d8; }
        .token-num { font-size: 3.5rem; font-weight: 900; color: #48cae4; }
        .patient-name { font-size: 1.5rem; color: #fff; }
        .doctor-title { font-size: 1.2rem; color: #caf0f8; }
        .badge-status { font-size: 1.2rem; padding: 8px 16px; border-radius: 20px; }
    </style>
</head>
<body>
    <div class="queue-header">
        <h1>OPD CONSULTATION LIVE QUEUE BOARD</h1>
        <p class="mb-0 text-info">Date: {{ date('d M Y') }} | Auto-refreshing every 10 seconds</p>
    </div>

    <div class="container-fluid p-4">
        <div class="row">
            @forelse($tokens as $token)
                <div class="col-md-4 col-lg-3">
                    <div class="token-card {{ $token->status == 'in_consultation' ? 'current-token' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="token-num">#{{ $token->token_number }}</span>
                            @if($token->status == 'in_consultation')
                                <span class="badge badge-success badge-status">IN ROOM</span>
                            @else
                                <span class="badge badge-warning badge-status">WAITING</span>
                            @endif
                        </div>
                        <div class="patient-name mt-2">{{ $token->patient->name ?? 'Patient' }}</div>
                        <div class="doctor-title mt-1">Dr. {{ $token->doctor->name ?? 'Doctor' }}</div>
                        <div class="text-muted small mt-1">{{ $token->department->name ?? 'General' }}</div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">No active patient tokens in queue at present.</h3>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
