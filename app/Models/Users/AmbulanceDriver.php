<?php

namespace App\Models\Users;

use App\Models\Cruds\Ambulance;
use App\Models\Cruds\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbulanceDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'gender',
        'phone',
        'license_number',
        'address',
    ];

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->withDefault([
            'path' => 'default/ambulanceDriver.png',
        ]);
    }
}
