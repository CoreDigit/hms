@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Create IPD Patient Discharge Summary</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">Discharge Medical Certificate & Summary Form</div>
            <div class="card-body">
                <form action="{{ route('discharge_summaries.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Select Admitted Patient / IPD Record <span class="text-danger">*</span></label>
                            <select name="admission_id" class="form-control select2" required>
                                <option value="">-- Choose IPD Admission --</option>
                                @foreach($admissions as $adm)
                                    <option value="{{ $adm->id }}" {{ ($selectedAdmission && $selectedAdmission->id == $adm->id) ? 'selected' : '' }}>
                                        #IPD-{{ $adm->id }} - {{ $adm->patient->name ?? 'Patient' }} (Ward: {{ $adm->ward->name ?? 'N/A' }} | Bed: #{{ $adm->bed->bed_number ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label>Attending Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" class="form-control select2" required>
                                <option value="">-- Choose Doctor --</option>
                                @foreach($doctors as $d)
                                    <option value="{{ $d->id }}">Dr. {{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Discharge Category <span class="text-danger">*</span></label>
                            <select name="discharge_type" class="form-control" required>
                                <option value="regular">Regular Discharge (Recovered/Improved)</option>
                                <option value="lama">LAMA (Left Against Medical Advice)</option>
                                <option value="transfer">Transferred to Higher Center</option>
                                <option value="death">Expired / Deceased</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label>Follow-Up Advice Date</label>
                            <input type="date" name="follow_up_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Final Diagnosis <span class="text-danger">*</span></label>
                        <input type="text" name="final_diagnosis" class="form-control" required placeholder="e.g. Acute Appendicitis - Post Laparoscopic Appendectomy">
                    </div>

                    <div class="form-group mb-3">
                        <label>Treatment Administered Summary</label>
                        <textarea name="treatment_summary" class="form-control" rows="3" placeholder="Surgical procedure details, IV antibiotics, IV fluids, analgesics administered..."></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Condition at Time of Discharge</label>
                        <input type="text" name="discharge_condition" class="form-control" placeholder="e.g. Patient stable, afebrile, wound clean and dry">
                    </div>

                    <div class="form-group mb-3">
                        <label>Post-Discharge Take Home Medications</label>
                        <textarea name="discharge_medications" class="form-control" rows="3" placeholder="Tab. Augmentin 625mg 1-0-1 x 5 days, Tab. Zero-P 1-0-1 x 3 days..."></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Dietary & Activity Instructions</label>
                        <textarea name="advice_instructions" class="form-control" rows="2" placeholder="Light soft diet, avoid heavy lifting for 2 weeks, daily wound dressing..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-file-pdf"></i> Generate Discharge Summary & Free Bed</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
