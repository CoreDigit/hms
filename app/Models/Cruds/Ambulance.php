<?php

namespace App\Models\Cruds;

use App\Models\Users\AmbulanceDriver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;

    public $fillable = ['type', 'number', 'model', 'year_made', 'status', 'ambulance_driver_id'];

    public function drivers()
    {
        return $this->hasMany(AmbulanceDriver::class);
    }
}
