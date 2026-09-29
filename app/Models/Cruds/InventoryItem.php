<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'item_name',
        'item_code',
        'category',
        'quantity',
        'unit',
        'min_reorder_level',
        'unit_price',
        'location_rack',
    ];

    public function supplier()
    {
        return $this->belongsTo(InventorySupplier::class, 'supplier_id');
    }
}
