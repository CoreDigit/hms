<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\DiagnosticRequest;
use App\Models\Cruds\Diagnostic;
use App\Models\Cruds\Lab;
use App\Models\Cruds\Ray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosticController extends Controller
{
    public function index($status = 'all')
    {
        $query = match (auth()->guard()->name) {
            'admin' => Diagnostic::query(),
            'doctor' => $this->getDoctorDiagnostics(auth()->user()),
        };

        $diagnostics = match ($status) {
            'all' => $query->latest()->get(),
            'pending' => $query->where('status', 'pending')->latest()->get(),
            'in-progress' => $query->where('status', 'in-progress')->latest()->get(),
            'completed' => $query->where('status', 'completed')->latest()->get(),
            default => [],
        };

        return view('cruds.diagnostics.index', compact('diagnostics'));
    }

    public function getDoctorDiagnostics($doctor)
    {
        return $doctor->diagnostics();
    }

    #####################################################

    public function diagnosis(DiagnosticRequest $request, Diagnostic $diagnostic)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            if ($data['re_diagnosis_date']) {
                $data['status'] = 'in-progress';
            } else {
                $data['status'] = 'completed';
                $diagnostic->appointment->update(['status' => 'completed']);
            }
            $diagnostic->update($data);
            DB::commit();
            return redirect()->route('doctor.diagnostics.index', 'all')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function redirectToRay(Request $request, Diagnostic $diagnostic)
    {
        $data = $request->validate(['description' => 'required']);

        $data['diagnostic_id'] = $diagnostic->id;
        $diagnostic->update(['status' => 'in-progress']);

        // create new ray
        Ray::create($data);

        return redirect()->route('doctor.diagnostics.index', 'all')->with('updated', __('validation.updated'));
    }

    public function redirectToLab(Request $request, Diagnostic $diagnostic)
    {
        $data = $request->validate(['description' => 'required']);

        $data['diagnostic_id'] = $diagnostic->id;
        $diagnostic->update(['status' => 'in-progress']);

        // create new lab
        Lab::create($data);

        return redirect()->route('doctor.diagnostics.index', 'all')->with('updated', __('validation.updated'));
    }
}
