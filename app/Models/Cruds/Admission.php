<?php

namespace App\Models\Cruds;

use App\Models\Users\Doctor;
use App\Models\Users\Nurse;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_number',
        'patient_id',
        'doctor_id',
        'nurse_id',
        'ward_id',
        'bed_id',
        'admission_date',
        'discharge_date',
        'admission_reason',
        'emergency_contact_name',
        'emergency_contact_phone',
        'advance_amount',
        'status',
        'discharge_reason',
        'created_by',
    ];

    protected $casts = [
        'admission_date' => 'datetime',
        'discharge_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function vitals()
    {
        return $this->hasMany(PatientVital::class);
    }

    public function nursingNotes()
    {
        return $this->hasMany(NursingNote::class);
    }

    public function dischargeSummary()
    {
        return $this->hasOne(DischargeSummary::class);
    }
}
