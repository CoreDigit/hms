<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'bed_number',
        'bed_type',
        'daily_charge',
        'status',
    ];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function admission()
    {
        return $this->hasOne(Admission::class)->where('status', 'admitted');
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }
}
