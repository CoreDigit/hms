<?php

namespace App\Models\Cruds;

use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DischargeSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_id',
        'patient_id',
        'doctor_id',
        'discharge_date',
        'discharge_type',
        'admission_reason',
        'final_diagnosis',
        'treatment_summary',
        'discharge_condition',
        'discharge_medications',
        'advice_instructions',
        'follow_up_date',
        'created_by',
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
