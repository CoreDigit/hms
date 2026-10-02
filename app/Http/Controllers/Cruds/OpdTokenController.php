<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\OpdToken;
use App\Models\Users\Patient;
use App\Models\Users\Doctor;
use App\Models\Cruds\Department;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OpdTokenController extends Controller
{
    public function index(Request $request)
    {
        $doctorId = $request->get('doctor_id');
        $status = $request->get('status');
        $date = $request->get('date', Carbon::today()->toDateString());

        $query = OpdToken::with(['patient', 'doctor', 'department'])
            ->whereDate('token_date', $date);

        if ($doctorId) {
            $query->where('doctor_id', $doctorId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $tokens = $query->orderBy('priority_level', 'desc')->orderBy('token_number', 'asc')->paginate(20);
        $doctors = Doctor::where('status', 1)->get();
        $departments = Department::all();

        return view('cruds.opd_tokens.index', compact('tokens', 'doctors', 'departments', 'doctorId', 'status', 'date'));
    }

    public function create()
    {
        $patients = Patient::select('id', 'name', 'uhid', 'phone', 'gender', 'age')->get();
        $doctors = Doctor::where('status', 1)->get();
        $departments = Department::all();

        return view('cruds.opd_tokens.create', compact('patients', 'doctors', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'token_type' => 'required|in:standard,emergency,vip,follow_up',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $today = Carbon::today()->toDateString();
        $lastToken = OpdToken::where('doctor_id', $request->doctor_id)
            ->whereDate('token_date', $today)
            ->max('token_number') ?? 0;

        $newTokenNumber = $lastToken + 1;
        $priority = 1;
        if ($request->token_type === 'emergency') $priority = 3;
        if ($request->token_type === 'vip') $priority = 2;

        $doctor = Doctor::find($request->doctor_id);

        $token = OpdToken::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'department_id' => $doctor->department_id ?? null,
            'token_number' => $newTokenNumber,
            'token_date' => $today,
            'token_type' => $request->token_type,
            'status' => 'waiting',
            'consultation_fee' => $request->consultation_fee,
            'payment_status' => 'paid',
            'priority_level' => $priority,
            'created_by' => Auth::id() ?? 1,
        ]);

        AuditLog::create([
            'user_type' => 'user',
            'user_id' => Auth::id() ?? 1,
            'action' => 'created',
            'module' => 'opd_token',
            'record_id' => $token->id,
            'description' => "OPD Token #{$token->token_number} generated for Patient ID {$token->patient_id}",
            'ip_address' => $request->ip(),
        ]);

        $printRoute = auth()->guard('receptionist')->check() ? 'receptionist.opd_tokens.print' : 'opd_tokens.print';
        return redirect()->route($printRoute, $token->id)
            ->with('success', "OPD Token #{$newTokenNumber} generated successfully!");
    }

    public function updateStatus(Request $request, $id)
    {
        $token = OpdToken::findOrFail($id);
        $request->validate([
            'status' => 'required|in:waiting,in_consultation,completed,cancelled,no_show',
        ]);

        $token->status = $request->status;
        if ($request->status === 'in_consultation' && !$token->called_at) {
            $token->called_at = now();
        }
        if ($request->status === 'completed' && !$token->completed_at) {
            $token->completed_at = now();
        }
        $token->save();

        return response()->json(['success' => true, 'message' => "Token status updated to {$request->status}"]);
    }

    public function queueScreen()
    {
        $today = Carbon::today()->toDateString();
        $tokens = OpdToken::with(['patient', 'doctor', 'department'])
            ->whereDate('token_date', $today)
            ->whereIn('status', ['waiting', 'in_consultation'])
            ->orderBy('priority_level', 'desc')
            ->orderBy('token_number', 'asc')
            ->get();

        return view('cruds.opd_tokens.queue_screen', compact('tokens'));
    }

    public function printSlip($id)
    {
        $token = OpdToken::with(['patient', 'doctor', 'department'])->findOrFail($id);
        return view('cruds.opd_tokens.print_slip', compact('token'));
    }
}
