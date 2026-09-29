<?php

namespace App\Models\Cruds;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleService extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['service_id', 'name', 'description'];
    public $translatedAttributes = ['name', 'description'];

    public function translations()
    {
        return $this->hasMany(SingleServiceTranslation::class);
    }

    public function multiServices()
    {
        return $this->belongsToMany(MultiService::class)->withPivot('quantity');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeActive($query)
    {
        return $query->whereHas('service', function ($query) {
            $query->where('status', true);
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('translations', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    ########## get attributes ##############

    public function getTotalPrice()
    {
        return $this->service->price * $this->pivot->quantity;
    }
}
