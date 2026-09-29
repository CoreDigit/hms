<?php

namespace App\Models\Cruds;

use App\Models\Users\Nurse;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVital extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_id',
        'recorded_at',
        'bp_systolic',
        'bp_diastolic',
        'pulse_rate',
        'temperature',
        'spo2',
        'respiration_rate',
        'weight',
        'height',
        'blood_sugar',
        'notes',
        'recorded_by',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function recorder()
    {
        return $this->belongsTo(Nurse::class, 'recorded_by');
    }
}
