<?php

namespace App\Models\Users;

use App\Models\Cruds\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HrStaff extends Authenticatable
{
    use HasFactory;

    protected $table = 'hr_staff';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
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
}
