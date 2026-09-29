<?php

namespace App\Models\Cruds;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['name', 'description', 'status', 'code', 'discount_percentage'];
    protected $translatedAttributes = ['name', 'description'];

    public function translations()
    {
        return $this->hasMany(InsuranceTranslation::class);
    }
}
