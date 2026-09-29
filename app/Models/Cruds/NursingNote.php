<?php

namespace App\Models\Cruds;

use App\Models\Users\Nurse;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NursingNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_id',
        'nurse_id',
        'note',
        'recorded_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}
