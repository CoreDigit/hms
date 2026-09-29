<?php

namespace App\Models\Cruds;

use App\Models\Users\Doctor;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    use Translatable;

    public $fillable = ['name', 'description'];
    public $translatedAttributes = ['name', 'description'];

    public function translations()
    {
        return $this->hasMany(DepartmentTranslation::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->withDefault([
            'path' => 'default/department.webp',
        ]);
    }

}
