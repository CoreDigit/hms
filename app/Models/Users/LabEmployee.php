<?php

namespace App\Models\Users;

use App\Models\Cruds\Image;
use App\Models\Cruds\Lab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LabEmployee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'gender',
        'phone',
        'bio',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->withDefault([
            'path' => 'default/labEmployee.png',
        ]);
    }

    public function labs()
    {
        return $this->hasMany(Lab::class);
    }
}
