<?php

namespace App\Models\Cruds;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiService extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['name', 'description', 'service_id', 'total_price', 'discount_value', 'tax_rate'];
    protected $casts = [
        'total_price' => 'decimal:2',
        'discount_value' => 'decimal:2',
        'tax_rate' => 'decimal:2',
    ];
    public $translatedAttributes = ['name', 'description'];

    public function translations()
    {
        return $this->hasMany(MultiServiceTranslation::class);
    }

    public function singleServices()
    {
        return $this->belongsToMany(SingleService::class, 'multi_service_single_service')->withPivot('quantity');
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

    ########## get attributes ##############

    public function getTotalAfterDiscount()
    {
        return $this->total_price - $this->discount_value;
    }

    public function getTaxValue()
    {
        return ($this->tax_rate / 100) * $this->getTotalAfterDiscount();
    }

    public function getTotalWithTax()
    {
        return $this->getTotalAfterDiscount() + $this->getTaxValue();
    }

    #########################################

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('translations', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
