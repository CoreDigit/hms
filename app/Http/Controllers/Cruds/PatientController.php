<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Cruds\PatientRequest;
use App\Http\Requests\Users\AdminLoginRequest;
use App\Models\Users\Patient;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PatientController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request)
    {
        if (auth()->guard('doctor')->check()) {
            $doctor = $request->user();
            $patients = $doctor->patients;
        } else {
            $patients = Patient::orderBy('updated_at', 'desc')->get();
        }
        return view('cruds.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('cruds.patients.create');
    }

    public function store(PatientRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        try {
            DB::beginTransaction();
            $patient = Patient::create($data);

            if (isset($data['image'])) {
                $username = strtok($patient->email, '@') . '.' . $data['image']->getClientOriginalExtension();
                $this->addImage($data['image'], $patient, 'patients', $username);
            }

            DB::commit();
            return redirect()->route('patients.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function show(Request $request, Patient $patient)
    {
        if (auth()->guard('patient')->check()) {
            $patient = $request->user();
        }
        return view('cruds.patients.show', compact('patient'))->with([
            'singleServiceInvoices' => $patient->singleServiceInvoices,
            'multiServiceInvoices' => $patient->multiServiceInvoices,
            'payments' => $patient->payments,
            'receipts' => $patient->receipts,
            'totalCredit' => $patient->sumCredit,
            'totalDebit' => $patient->sumDebit,
            'labs' => $patient->labs,
            'rays' => $patient->rays,
        ]);
    }

    public function edit(Patient $patient)
    {
        return view('cruds.patients.edit', compact('patient'));
    }

    public function update(PatientRequest $request, Patient $patient)
    {
        if (auth()->guard('patient')->check()) {
            $patient = $request->user();
        }

        $data = $request->validated();
        try {
            DB::beginTransaction();
            $patient->update($data);

            if ($request->has('remove_image')) {
                if ($patient->image->path !== 'default/patient.webp') {
                    $this->deleteImage($patient->image);
                }
            } else if ($request->has('image')) {
                if ($patient->image->path !== 'default/patient.webp') {
                    $this->deleteImage($patient->image);
                }
                $username = strtok($patient->email, '@') . '.' . $data['image']->getClientOriginalExtension();
                $this->addImage($data['image'], $patient, 'patients', $username);
            }

            DB::commit();
            return redirect()->route(auth()->guard('patient')->check() ? 'patient.show' : 'patients.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(Request $request, Patient $patient)
    {
        $request->validate([
            'last_password' => ['required'],
        ]);
        if (auth()->guard('patient')->check()) {
            $request->validate([
                'last_password' => ['current_password'],
            ]);
            $patient = $request->user();
            Auth::logout();
            $patient->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return Redirect::to('/');
        }
        if (Hash::check($request->last_password, auth()->user()->password)) {
            $patient->delete();
            return redirect()->route('patients.index')->with('deleted', __('validation.deleted'));
        }
        return redirect()->back()->with('password_error', __('validation.password_error'));
    }

    ################################################################

    public function updatePassword(PasswordRequest $request, Patient $patient)
    {
        if (auth()->guard('patient')->check()) {
            $patient = $request->user();
        }

        $data = $request->validated();
        if (Hash::check($data['current_password'], $patient->password)) {
            $patient->update(['password' => Hash::make($data['password'])]);
            return auth()->guard('patient')->check() ?
                redirect()->route('patient.show')->with('password', __('validation.password_updated')) :
                redirect()->route('patients.show', $patient->id)->with('password', __('validation.password_updated'));
        }
        return redirect()->back()->with('password_error', __('validation.password_error'));
    }

    public function showRecords(Request $request, Patient $patient)
    {
        if (auth()->guard('patient')->check()) {
            $patient = $request->user();
        }
        $appointments = $patient->appointments;
        $diagnostics = $patient->diagnostics;
        $records = $appointments->concat($diagnostics)->sortBy('created_at')->values();

        return view('cruds.patients.records', compact('patient', 'records'));
    }

    public function showAccounts(AdminLoginRequest $request, Patient $patient)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return view('cruds.patients.show-patient-account', compact('patient'));
    }
}
