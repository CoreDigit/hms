<?php

namespace App\Models\Cruds;

use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'amount', 'case', 'transaction_type', 'transaction_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function scopeFindByTransaction($query, $type, $id)
    {
        // Used as: $patientAccount = PatientAccount::findByTransaction('invoice', $invoice->id);
        return $query->where('transaction_type', $type)->where('transaction_id', $id)->first();
    }

    public function transaction()
    {
        // Used as: $patientAccount->transaction;
        // Return as: Payment || Receipt || Invoice
        return match ($this->transaction_type) {
            'payment' => Payment::find($this->transaction_id),
            'receipt' => Receipt::find($this->transaction_id),
            'invoice' => Invoice::find($this->transaction_id),
        };
    }
}
