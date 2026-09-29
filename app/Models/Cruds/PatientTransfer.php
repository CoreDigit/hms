<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_id',
        'from_bed_id',
        'to_bed_id',
        'transfer_date',
        'reason',
        'transferred_by',
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function fromBed()
    {
        return $this->belongsTo(Bed::class, 'from_bed_id');
    }

    public function toBed()
    {
        return $this->belongsTo(Bed::class, 'to_bed_id');
    }
}
