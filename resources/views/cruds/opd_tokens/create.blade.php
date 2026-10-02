@extends(auth()->guard('receptionist')->check() ? 'users.receptionist.layouts.master' : 'users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Issue OPD Consultation Token</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">Generate Token</div>
            <div class="card-body">
                <form action="{{ auth()->guard('receptionist')->check() ? route('receptionist.opd_tokens.store') : route('opd_tokens.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Select Patient <span class="text-danger">*</span></label>
                        <select name="patient_id" class="form-control select2" required>
                            <option value="">-- Choose Patient --</option>
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} (UHID: {{ $p->uhid ?? 'N/A' }} | Phone: {{ $p->phone }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Select Doctor <span class="text-danger">*</span></label>
                        <select name="doctor_id" id="doctor_select" class="form-control select2" required>
                            <option value="">-- Choose Doctor --</option>
                            @foreach($doctors as $d)
                                <option value="{{ $d->id }}" data-fee="{{ $d->price ?? 500 }}">Dr. {{ $d->name }} ({{ $d->department->name ?? 'General' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Token Priority Category</label>
                        <select name="token_type" class="form-control">
                            <option value="standard">Standard Walk-in</option>
                            <option value="emergency">Emergency (Highest Priority)</option>
                            <option value="vip">VIP Patient</option>
                            <option value="follow_up">Follow Up Visit</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Consultation Fee (₹)</label>
                        <input type="number" step="0.01" name="consultation_fee" id="consultation_fee" class="form-control" value="500.00" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-ticket-alt"></i> Generate & Print OPD Slip</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#doctor_select').on('change', function() {
        var fee = $(this).find(':selected').data('fee');
        if(fee) {
            $('#consultation_fee').val(fee);
        }
    });
</script>
@endsection
