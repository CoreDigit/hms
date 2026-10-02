@extends(auth()->guard('receptionist')->check() ? 'users.receptionist.layouts.master' : 'users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">New IPD Patient Admission</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-9 mx-auto">
        <div class="card">
            <div class="card-header">IPD Admission Form</div>
            <div class="card-body">
                <form action="{{ auth()->guard('receptionist')->check() ? route('receptionist.admissions.store') : route('admissions.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Patient <span class="text-danger">*</span></label>
                            <select name="patient_id" class="form-control select2" required>
                                <option value="">-- Choose Patient --</option>
                                @foreach($patients as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }} (UHID: {{ $p->uhid ?? 'N/A' }} | Phone: {{ $p->phone }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Attending Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" class="form-control select2" required>
                                <option value="">-- Choose Doctor --</option>
                                @foreach($doctors as $d)
                                    <option value="{{ $d->id }}">Dr. {{ $d->name }} ({{ $d->department->name ?? 'General' }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Select Available Bed <span class="text-danger">*</span></label>
                            <select name="bed_id" class="form-control select2" required>
                                <option value="">-- Choose Available Bed --</option>
                                @foreach($availableBeds as $b)
                                    <option value="{{ $b->id }}">{{ $b->ward->name ?? 'Ward' }} - Bed #{{ $b->bed_number }} (₹{{ number_format($b->daily_charge, 2) }}/day)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Advance Deposit Amount (₹)</label>
                            <input type="number" step="0.01" name="advance_amount" class="form-control" value="5000.00">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" class="form-control" placeholder="Relative / Guardian Name">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Emergency Contact Phone</label>
                            <input type="text" name="emergency_contact_phone" class="form-control" placeholder="Contact Mobile Number">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Reason for Admission / Initial Diagnosis</label>
                        <textarea name="admission_reason" class="form-control" rows="3" placeholder="Chief complaints, symptoms, diagnosis..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-bed"></i> Admit Patient</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
