<?php

namespace App\Models\Users;

use App\Models\Cruds\Appointment;
use App\Models\Cruds\Diagnostic;
use App\Models\Cruds\Image;
use App\Models\Cruds\Invoice;
use App\Models\Cruds\Lab;
use App\Models\Cruds\PatientAccount;
use App\Models\Cruds\Payment;
use App\Models\Cruds\Ray;
use App\Models\Cruds\Receipt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'blood_type',
        'birth_date',
        'address',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->withDefault([
            'path' => 'default/patient.webp'
        ]);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class);
    }

    public function doctors()
    {
        return $this->hasManyThrough(Doctor::class, Diagnostic::class, 'patient_id', 'id', 'id', 'doctor_id');
    }

    public function labs()
    {
        return $this->hasManyThrough(Lab::class, Diagnostic::class);
    }

    public function rays()
    {
        return $this->hasManyThrough(Ray::class, Diagnostic::class);
    }

    public function accounts()
    {
        return $this->hasMany(PatientAccount::class);
    }

    public function singleServiceInvoices()
    {
        return $this->hasMany(Invoice::class)->whereHas('service', function ($query) {
            $query->where('type', 'single');
        });
    }

    public function multiServiceInvoices()
    {
        return $this->hasMany(Invoice::class)->whereHas('service', function ($query) {
            $query->where('type', 'multi');
        });
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function getSumCreditAttribute()
    {
        return $this->accounts()->where('case', 'credit')->sum('amount');
    }

    public function getSumDebitAttribute()
    {
        return $this->accounts()->where('case', 'debit')->sum('amount');
    }

    /****************************************************/
    // Note: I delet manually from PatientAccount and FundAccount cause I didn't make foriegnId and...
    // instead to save space (I don't know why) made 'transaction_type' and 'transaction_id'

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($patient) {
            // Delete associated invoices, which will trigger deleting events in Invoice model
            $patient->invoices->each->delete();
        });
    }
}
