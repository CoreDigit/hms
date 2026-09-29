<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\Appointment;
use App\Models\Cruds\Diagnostic;
use App\Models\Users\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index($status = 'all')
    {
        $query = match (auth()->guard()->name) {
            'admin' => Appointment::query(),
            'doctor' => $this->getAppointments(auth()->user()),
            'patient' => $this->getAppointments(auth()->user()),
        };

        $appointments = match ($status) {
            'all' => $query->latest()->get(),
            'pending' => $query->where('status', 'pending')->latest()->get(),
            'in-progress' => $query->where('status', 'in-progress')->latest()->get(),
            'completed' => $query->where('status', 'completed')->latest()->get(),
            default => [],
        };

        return view('cruds.appointments.index', compact('appointments'));
    }

    public function getAppointments($user)
    {
        return $user->appointments();
        // this stupid function just for avoid VSCode problem which give error on auth()->user()->appointments()!
    }

    public function store()
    {
        return 'appointment';
    }

    public function storewithDoctor(Doctor $doctor)
    {
        return $doctor;
    }

    ########################################

    public function approve(Request $request, Appointment $appointment)
    {
        $data = $request->validate(['time' => 'required']);
        $data['status'] = 'in-progress';
        try {
            DB::beginTransaction();

            $appointment->update($data);

            // create new diagnostic
            Diagnostic::create([
                'appointment_id' => $appointment->id,
                'doctor_id' => $appointment->doctor->id,
                'patient_id' => $appointment->patient->id,
            ]);

            DB::commit();
            return redirect()->route('doctor.appointments.index', 'all')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function refuse(Appointment $appointment)
    {
        try {
            DB::beginTransaction();
            
            $appointment->delete();
            
            DB::commit();
            return redirect()->route('doctor.appointments.index', 'all')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }
}
