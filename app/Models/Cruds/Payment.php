<?php

namespace App\Models\Cruds;

use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'notes', 'patient_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /****************************************************/
    // Note: I delet manually from PatientAccount and FundAccount cause I didn't make foriegnId and...
    // instead to save space (I don't know why) made 'transaction_type' and 'transaction_id'

    public function patientAccount()
    {
        return $this->hasOne(PatientAccount::class, 'transaction_id')->where('transaction_type', 'payment');
    }

    public function fundAccount()
    {
        return $this->hasOne(FundAccount::class, 'transaction_id')->where('transaction_type', 'payment');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($payment) {
            // Delete related patient_accounts records
            $payment->patientAccount->delete();
            $payment->fundAccount->delete();
        });
    }
}
