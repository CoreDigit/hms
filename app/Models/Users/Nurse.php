<?php

namespace App\Models\Users;

use App\Models\Cruds\Department;
use App\Models\Cruds\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Nurse extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'department_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->withDefault([
            'path' => 'default/admin.png',
        ]);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
