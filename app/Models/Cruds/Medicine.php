<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'generic_name',
        'manufacturer',
        'batch_number',
        'unit_price',
        'purchase_price',
        'stock_quantity',
        'reorder_level',
        'expiry_date',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(MedicineCategory::class, 'category_id');
    }
}
