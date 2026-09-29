<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ward_type',
        'floor_number',
        'daily_charge',
        'description',
    ];

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}
