<?php

namespace App\Models\Cruds;

use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis',
        'medicines',
        're_diagnosis_date',
        'status',
        'appointment_id',
        'doctor_id',
        'patient_id',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function lab()
    {
        return $this->hasOne(Lab::class)->withDefault([
            'description' => '',
        ]);
    }

    public function ray()
    {
        return $this->hasOne(Ray::class)->withDefault([
            'description' => '',
        ]);
    }

    public function getRecordTypeAttribute()
    {
        return 'diagnostic';
    }
}
