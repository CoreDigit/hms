<?php

namespace App\Models\Cruds;

use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdToken extends Model
{
    use HasFactory;

    protected $table = 'opd_tokens';

    protected $fillable = [
        'token_number',
        'token_date',
        'patient_id',
        'doctor_id',
        'department_id',
        'token_type',
        'status',
        'consultation_fee',
        'payment_status',
        'priority_level',
        'called_at',
        'completed_at',
        'created_by',
    ];

    protected $casts = [
        'called_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
