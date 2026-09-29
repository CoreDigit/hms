<?php

namespace App\Models\Cruds;

use App\Models\Users\RayEmployee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ray extends Model
{
    use HasFactory;

    public $fillable = ['description', 'diagnosis', 'status', 'diagnostic_id', 'ray_employee_id'];

    public function rayEmployee()
    {
        return $this->belongsTo(RayEmployee::class);
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
