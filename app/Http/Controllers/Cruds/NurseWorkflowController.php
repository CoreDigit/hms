<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\PatientVital;
use App\Models\Cruds\NursingNote;
use App\Models\Users\Patient;
use App\Models\Cruds\Admission;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NurseWorkflowController extends Controller
{
    public function index(Request $request)
    {
        $patientId = $request->get('patient_id');
        $patients = Patient::all();
        $admissions = Admission::with('patient')->where('status', 'admitted')->get();

        $vitalsQuery = PatientVital::with(['patient', 'recorder']);
        if ($patientId) {
            $vitalsQuery->where('patient_id', $patientId);
        }
        $vitals = $vitalsQuery->latest('recorded_at')->paginate(15);

        $notesQuery = NursingNote::with(['patient', 'admission', 'nurse']);
        if ($patientId) {
            $notesQuery->where('patient_id', $patientId);
        }
        $notes = $notesQuery->latest('recorded_at')->take(10)->get();

        return view('cruds.nurse.workflow', compact('patients', 'admissions', 'vitals', 'notes', 'patientId'));
    }

    public function storeVitals(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'bp_systolic' => 'nullable|integer',
            'bp_diastolic' => 'nullable|integer',
            'pulse_rate' => 'nullable|integer',
            'temperature' => 'nullable|numeric',
            'spo2' => 'nullable|integer',
            'respiration_rate' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'blood_sugar' => 'nullable|numeric',
        ]);

        $vital = PatientVital::create([
            'patient_id' => $request->patient_id,
            'admission_id' => $request->admission_id,
            'recorded_at' => now(),
            'bp_systolic' => $request->bp_systolic,
            'bp_diastolic' => $request->bp_diastolic,
            'pulse_rate' => $request->pulse_rate,
            'temperature' => $request->temperature,
            'spo2' => $request->spo2,
            'respiration_rate' => $request->respiration_rate,
            'weight' => $request->weight,
            'height' => $request->height,
            'blood_sugar' => $request->blood_sugar,
            'notes' => $request->notes,
            'recorded_by' => Auth::id() ?? 1,
        ]);

        AuditLog::create([
            'user_type' => 'user',
            'user_id' => Auth::id() ?? 1,
            'action' => 'created',
            'module' => 'vitals',
            'record_id' => $vital->id,
            'description' => "Vitals recorded for Patient ID {$vital->patient_id}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Patient vitals saved successfully!');
    }

    public function storeNote(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'note' => 'required|string',
        ]);

        NursingNote::create([
            'patient_id' => $request->patient_id,
            'admission_id' => $request->admission_id,
            'nurse_id' => Auth::id() ?? 1,
            'note' => $request->note,
            'recorded_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Nursing note saved successfully!');
    }
}
