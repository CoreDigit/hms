<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_invoice_id',
        'medicine_id',
        'medicine_name',
        'unit_price',
        'quantity',
        'total_price',
    ];

    public function invoice()
    {
        return $this->belongsTo(PharmacyInvoice::class, 'pharmacy_invoice_id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
