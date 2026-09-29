<?php

namespace App\Models\Cruds;

use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'notes',
        'status',
        'invoice_id',
        'patient_id', 
        'doctor_id',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function diagnostic()
    {
        return $this->hasOne(Diagnostic::class);
    }

    public function getRecordTypeAttribute()
    {
        return 'appointment';
    }
}
