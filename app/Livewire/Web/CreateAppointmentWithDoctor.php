<?php

namespace App\Livewire\Web;

use App\Models\Cruds\Appointment;
use App\Models\Cruds\Department;
use App\Models\Users\Doctor;
use Livewire\Component;

class CreateAppointmentWithDoctor extends Component
{
    public $appointment_booked = false;
    public $appointment_there = false;
    public $appointment_date_error = false;
    public $patient_id;
    public $doctor_id;
    public $date, $notes;

    public function render()
    {
        return view('livewire.web.create-appointment-with-doctor');
    }

    public function store()
    {
        $data = $this->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'patient_id' => ['required', 'exists:patients,id'],
            'date' => ['required', 'date', 'after:yesterday'],
            'notes' => 'nullable',
        ]);

        $this->resetAlerts();

        $this->appointment_there = Appointment::where('doctor_id', $this->doctor_id)
            ->where('patient_id', $this->patient_id)
            ->where('status', 'pending')->exists();
        if ($this->appointment_there) {
            return;
        }

        $doctor = Doctor::find($this->doctor_id);
        
        $this->appointment_date_error =  $doctor->appointments->where('date', $this->date)->count() > $doctor->number_of_appointments;
        if ($this->appointment_date_error) {
            return;
        }

        Appointment::create($data);
        $this->appointment_booked = true;
    }

    public function resetForm()
    {
        $this->reset([
            'department_id',
            'doctor_id',
            'date',
            'notes',
        ]);
    }

    public function resetAlerts()
    {
        $this->reset([
            'appointment_booked',
            'appointment_there',
            'appointment_date_error',
        ]);
    }
}
