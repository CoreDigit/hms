<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AdminLoginRequest;
use App\Models\Cruds\PatientAccount;
use Illuminate\Http\Request;

class PatientAccountController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->guard('patient')->check()) {
            $patient = $request->user();
            $patientAccounts = $patient->accounts;
        } else {
            $patientAccounts = PatientAccount::all();
        }
        return view('cruds.patient-accounts.index', compact('patientAccounts'));
    }

    public function show(PatientAccount $patientAccount)
    {
        return view('cruds.patient-accounts.show', compact('patientAccount'));
    }
}
