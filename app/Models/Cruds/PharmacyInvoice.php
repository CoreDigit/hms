<?php

namespace App\Models\Cruds;

use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use App\Models\Users\Pharmacist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'patient_id',
        'customer_name',
        'customer_phone',
        'total_amount',
        'discount_amount',
        'tax_amount',
        'net_amount',
        'paid_amount',
        'payment_status',
        'payment_mode',
        'sold_by',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function seller()
    {
        return $this->belongsTo(Pharmacist::class, 'sold_by');
    }

    public function items()
    {
        return $this->hasMany(PharmacyInvoiceItem::class);
    }
}
