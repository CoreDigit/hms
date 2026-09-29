<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\Prescription;
use App\Models\Cruds\PrescriptionItem;
use App\Models\Cruds\Medicine;
use App\Models\Users\Patient;
use App\Models\Users\Doctor;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $patientId = $request->get('patient_id');
        $prescriptions = Prescription::with(['patient', 'doctor', 'items.medicine'])
            ->when($patientId, function ($q) use ($patientId) {
                return $q->where('patient_id', $patientId);
            })
            ->latest('prescription_date')
            ->paginate(15);

        return view('cruds.prescriptions.index', compact('prescriptions', 'patientId'));
    }

    public function create(Request $request)
    {
        $patients = Patient::all();
        $doctors = Doctor::where('status', 1)->get();
        $medicines = Medicine::where('is_active', true)->get();
        $selectedPatientId = $request->get('patient_id');

        return view('cruds.prescriptions.create', compact('patients', 'doctors', 'medicines', 'selectedPatientId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string',
            'medicines' => 'nullable|array',
            'medicines.*.name' => 'required_with:medicines|string',
            'medicines.*.dosage' => 'nullable|string',
            'medicines.*.frequency' => 'nullable|string',
            'medicines.*.duration' => 'nullable|string',
            'medicines.*.instructions' => 'nullable|string',
        ]);

        $prescription = Prescription::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'prescription_date' => now(),
            'chief_complaints' => $request->chief_complaints,
            'diagnosis' => $request->diagnosis,
            'advice' => $request->advice,
            'follow_up_date' => $request->follow_up_date,
            'created_by' => Auth::id() ?? 1,
        ]);

        if (!empty($request->medicines)) {
            foreach ($request->medicines as $item) {
                if (!empty($item['name'])) {
                    $med = Medicine::where('name', $item['name'])->first();
                    PrescriptionItem::create([
                        'prescription_id' => $prescription->id,
                        'medicine_id' => $med ? $med->id : null,
                        'medicine_name' => $item['name'],
                        'dosage' => $item['dosage'] ?? '',
                        'frequency' => $item['frequency'] ?? '',
                        'duration' => $item['duration'] ?? '',
                        'instructions' => $item['instructions'] ?? '',
                    ]);
                }
            }
        }

        AuditLog::create([
            'user_type' => 'user',
            'user_id' => Auth::id() ?? 1,
            'action' => 'created',
            'module' => 'prescription',
            'record_id' => $prescription->id,
            'description' => "Prescription ID {$prescription->id} generated for Patient ID {$prescription->patient_id}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('prescriptions.print', $prescription->id)->with('success', 'Prescription generated successfully!');
    }

    public function show($id)
    {
        $prescription = Prescription::with(['patient', 'doctor', 'items.medicine'])->findOrFail($id);
        return view('cruds.prescriptions.show', compact('prescription'));
    }

    public function printSlip($id)
    {
        $prescription = Prescription::with(['patient', 'doctor', 'items.medicine'])->findOrFail($id);
        return view('cruds.prescriptions.print_slip', compact('prescription'));
    }
}
