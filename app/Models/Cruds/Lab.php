<?php

namespace App\Models\Cruds;

use App\Models\Users\LabEmployee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    public $fillable = ['description', 'diagnosis', 'status', 'diagnostic_id', 'lab_employee_id'];

    public function labEmployee()
    {
        return $this->belongsTo(LabEmployee::class);
    }

    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
