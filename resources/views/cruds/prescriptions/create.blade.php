@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Create Doctor Prescription (Rx)</h4>
    </div>
</div>

<form action="{{ route('prescriptions.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Patient & Diagnosis Info</div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Patient <span class="text-danger">*</span></label>
                        <select name="patient_id" class="form-control select2" required>
                            <option value="">-- Select Patient --</option>
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}" {{ $selectedPatientId == $p->id ? 'selected' : '' }}>{{ $p->name }} (UHID: {{ $p->uhid ?? 'N/A' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Prescribing Doctor <span class="text-danger">*</span></label>
                        <select name="doctor_id" class="form-control select2" required>
                            <option value="">-- Select Doctor --</option>
                            @foreach($doctors as $d)
                                <option value="{{ $d->id }}">Dr. {{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Chief Complaints</label>
                        <textarea name="chief_complaints" class="form-control" rows="2" placeholder="e.g. Fever, cough, headache for 3 days"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Diagnosis <span class="text-danger">*</span></label>
                        <textarea name="diagnosis" class="form-control" rows="2" required placeholder="e.g. Acute Upper Respiratory Tract Infection"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Advice / Diet Instructions</label>
                        <textarea name="advice" class="form-control" rows="2" placeholder="e.g. Drink warm water, rest, avoid cold food"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Follow-Up Date</label>
                        <input type="date" name="follow_up_date" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Prescribed Medicines</h5>
                    <button type="button" class="btn btn-sm btn-light" id="add_medicine_row"><i class="fa fa-plus"></i> Add Medicine Row</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="medicines_table">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Dosage</th>
                                <th>Frequency</th>
                                <th>Duration</th>
                                <th>Instructions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="medicines[0][name]" class="form-control" list="med_list" required placeholder="Medicine Name">
                                </td>
                                <td><input type="text" name="medicines[0][dosage]" class="form-control" placeholder="1 Tab / 5ml"></td>
                                <td><input type="text" name="medicines[0][frequency]" class="form-control" placeholder="1-0-1"></td>
                                <td><input type="text" name="medicines[0][duration]" class="form-control" placeholder="5 Days"></td>
                                <td><input type="text" name="medicines[0][instructions]" class="form-control" placeholder="After food"></td>
                                <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>

                    <datalist id="med_list">
                        @foreach($medicines as $m)
                            <option value="{{ $m->name }}">{{ $m->generic_name }}</option>
                        @endforeach
                    </datalist>

                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-3"><i class="fa fa-print"></i> Generate & Print Prescription</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var rowIdx = 1;
    $('#add_medicine_row').on('click', function() {
        var html = `<tr>
            <td><input type="text" name="medicines[${rowIdx}][name]" class="form-control" list="med_list" required placeholder="Medicine Name"></td>
            <td><input type="text" name="medicines[${rowIdx}][dosage]" class="form-control" placeholder="1 Tab / 5ml"></td>
            <td><input type="text" name="medicines[${rowIdx}][frequency]" class="form-control" placeholder="1-0-1"></td>
            <td><input type="text" name="medicines[${rowIdx}][duration]" class="form-control" placeholder="5 Days"></td>
            <td><input type="text" name="medicines[${rowIdx}][instructions]" class="form-control" placeholder="After food"></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>
        </tr>`;
        $('#medicines_table tbody').append(html);
        rowIdx++;
    });

    $(document).on('click', '.remove-row', function() {
        if($('#medicines_table tbody tr').length > 1) {
            $(this).closest('tr').remove();
        }
    });
</script>
@endsection
