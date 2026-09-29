<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\Admission;
use App\Models\Cruds\Bed;
use App\Models\Cruds\Ward;
use App\Models\Users\Patient;
use App\Models\Users\Doctor;
use App\Models\Cruds\PatientTransfer;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'admitted');
        $admissions = Admission::with(['patient', 'doctor', 'ward', 'bed'])
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->latest('admission_date')
            ->paginate(15);

        return view('cruds.admissions.index', compact('admissions', 'status'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::where('status', 1)->get();
        $availableBeds = Bed::with('ward')->where('status', 'available')->get();

        return view('cruds.admissions.create', compact('patients', 'doctors', 'availableBeds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'bed_id' => 'required|exists:beds,id',
            'admission_reason' => 'nullable|string',
            'advance_amount' => 'nullable|numeric|min:0',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_phone' => 'nullable|string',
        ]);

        $bed = Bed::findOrFail($request->bed_id);

        $admission = Admission::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'ward_id' => $bed->ward_id,
            'bed_id' => $bed->id,
            'admission_date' => now(),
            'admission_reason' => $request->admission_reason,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'advance_amount' => $request->advance_amount ?? 0,
            'status' => 'admitted',
            'created_by' => Auth::id() ?? 1,
        ]);

        $bed->status = 'occupied';
        $bed->save();

        AuditLog::create([
            'user_type' => 'user',
            'user_id' => Auth::id() ?? 1,
            'action' => 'created',
            'module' => 'ipd_admission',
            'record_id' => $admission->id,
            'description' => "Patient ID {$admission->patient_id} admitted to Bed #{$bed->bed_number}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admissions.index')->with('success', 'Patient admitted successfully!');
    }

    public function transfer(Request $request, $id)
    {
        $admission = Admission::findOrFail($id);
        $request->validate([
            'new_bed_id' => 'required|exists:beds,id',
            'reason' => 'nullable|string',
        ]);

        $oldBed = Bed::find($admission->bed_id);
        $newBed = Bed::findOrFail($request->new_bed_id);

        if ($newBed->status !== 'available') {
            return back()->withErrors(['new_bed_id' => 'Selected bed is not available.']);
        }

        PatientTransfer::create([
            'admission_id' => $admission->id,
            'from_bed_id' => $oldBed ? $oldBed->id : null,
            'to_bed_id' => $newBed->id,
            'transfer_date' => now(),
            'reason' => $request->reason,
            'transferred_by' => Auth::id() ?? 1,
        ]);

        if ($oldBed) {
            $oldBed->status = 'cleaning';
            $oldBed->save();
        }

        $newBed->status = 'occupied';
        $newBed->save();

        $admission->ward_id = $newBed->ward_id;
        $admission->bed_id = $newBed->id;
        $admission->save();

        return redirect()->back()->with('success', "Patient transferred to Bed #{$newBed->bed_number} successfully!");
    }

    public function discharge(Request $request, $id)
    {
        $admission = Admission::findOrFail($id);
        
        if ($admission->bed_id) {
            $bed = Bed::find($admission->bed_id);
            if ($bed) {
                $bed->status = 'cleaning';
                $bed->save();
            }
        }

        $admission->status = 'discharged';
        $admission->discharge_date = now();
        $admission->discharge_reason = $request->discharge_reason ?? 'Normal Discharge';
        $admission->save();

        return redirect()->route('admissions.index')->with('success', 'Patient marked as discharged!');
    }
}
