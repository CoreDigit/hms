<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\DischargeSummary;
use App\Models\Cruds\Admission;
use App\Models\Cruds\Bed;
use App\Models\Users\Doctor;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DischargeSummaryController extends Controller
{
    public function index()
    {
        $summaries = DischargeSummary::with(['admission.patient', 'doctor'])->latest('discharge_date')->paginate(15);
        return view('cruds.discharge_summaries.index', compact('summaries'));
    }

    public function create(Request $request)
    {
        $admissionId = $request->get('admission_id');
        $admissions = Admission::with(['patient', 'doctor', 'ward', 'bed'])
            ->where('status', 'admitted')
            ->get();
        $doctors = Doctor::where('status', 1)->get();
        $selectedAdmission = $admissionId ? Admission::with(['patient', 'doctor'])->find($admissionId) : null;

        return view('cruds.discharge_summaries.create', compact('admissions', 'doctors', 'selectedAdmission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admission_id' => 'required|exists:admissions,id',
            'doctor_id' => 'required|exists:doctors,id',
            'discharge_type' => 'required|in:regular,lama,transfer,death',
            'final_diagnosis' => 'required|string',
        ]);

        $admission = Admission::findOrFail($request->admission_id);

        $summary = DischargeSummary::create([
            'admission_id' => $admission->id,
            'patient_id' => $admission->patient_id,
            'doctor_id' => $request->doctor_id,
            'discharge_date' => now(),
            'discharge_type' => $request->discharge_type,
            'admission_reason' => $request->admission_reason ?? $admission->admission_reason,
            'final_diagnosis' => $request->final_diagnosis,
            'treatment_summary' => $request->treatment_summary,
            'discharge_condition' => $request->discharge_condition,
            'discharge_medications' => $request->discharge_medications,
            'advice_instructions' => $request->advice_instructions,
            'follow_up_date' => $request->follow_up_date,
            'created_by' => Auth::id() ?? 1,
        ]);

        // Free bed and update admission status
        if ($admission->bed_id) {
            $bed = Bed::find($admission->bed_id);
            if ($bed) {
                $bed->status = 'cleaning';
                $bed->save();
            }
        }
        $admission->status = 'discharged';
        $admission->discharge_date = now();
        $admission->discharge_reason = $request->discharge_type;
        $admission->save();

        AuditLog::create([
            'user_type' => 'user',
            'user_id' => Auth::id() ?? 1,
            'action' => 'created',
            'module' => 'discharge_summary',
            'record_id' => $summary->id,
            'description' => "Discharge Summary created for Admission ID {$admission->id}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('discharge_summaries.print', $summary->id)
            ->with('success', 'Discharge Summary generated successfully!');
    }

    public function printSlip($id)
    {
        $summary = DischargeSummary::with(['admission.patient', 'doctor', 'patient'])->findOrFail($id);
        return view('cruds.discharge_summaries.print_slip', compact('summary'));
    }
}
