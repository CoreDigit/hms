<?php

namespace App\Models\Cruds;

use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['case', 'service_id', 'patient_id', 'doctor_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public static function sumInvoices($case = null)
    {
        $query = Invoice::join('services', 'invoices.service_id', '=', 'services.id');

        if ($case) {
            $query->where('case', $case);
        }

        return $query->sum('services.price');
    }

    /****************************************************/
    // Note: I delet manually from PatientAccount and FundAccount cause I didn't make foriegnId and...
    // instead to save space (I don't know why) made 'transaction_type' and 'transaction_id'

    public function patientAccount()
    {
        return $this->hasOne(PatientAccount::class, 'transaction_id')->where('transaction_type', 'invoice');
    }

    public function fundAccount()
    {
        return $this->hasOne(FundAccount::class, 'transaction_id')->where('transaction_type', 'invoice');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($invoice) {
            // Delete related patient_accounts records
            $invoice->patientAccount->delete();
            $invoice->fundAccount->delete();
        });
    }
}
