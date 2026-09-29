<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\PatientRegisterRequest;
use App\Http\Requests\Users\PatientLoginRequest;
use App\Models\Users\Patient;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientLoginController extends Controller
{
    public function index()
    {
        $patient = auth()->user();
        $statistics = $this->getStatistics(auth()->user());
        return view('users.patient.dashboard', compact('patient', 'statistics'));
    }

    public function getStatistics(Patient $patient)
    {
        return [
            'all' => [
                'patients' => $patient->doctors()->count(),
                'singleServiceInvoices' => $patient->singleServiceInvoices()->count(),
                'multiServiceInvoices' => $patient->multiServiceInvoices()->count(),
                'payments' => $patient->payments()->count(),
                'receipts' => $patient->receipts()->count(),
                'appointments' => $patient->appointments()->count(),
                'labs' => $patient->labs()->count(),
                'rays' => $patient->rays()->count(),
                'diagnostics' => $patient->diagnostics->count(),
            ],
            'pending' => [
                'appointments' => $patient->appointments()->where('status', 'pending')->count(),
            ],
            'in-progress' => [
                'appointments' => $patient->appointments()->where('status', 'in-progress')->count(),
            ],
            'completed' => [
                'appointments' => $patient->appointments()->where('status', 'completed')->count(),
            ],
            'total' => [
                'credit' => $patient->sumCredit,
                'debit' => $patient->sumDebit,
            ],
        ];
    }

    public function store(PatientLoginRequest $request)
    {
        $request->authenticate();
        
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME['patient']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('patient')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(PatientRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $patient = Patient::create($data);

        Auth::guard('patient')->login($patient);

        return redirect(RouteServiceProvider::HOME['patient']);
    }
}
