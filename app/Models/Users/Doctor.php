<?php

namespace App\Models\Users;

use App\Models\Cruds\Appointment;
use App\Models\Cruds\Diagnostic;
use App\Models\Cruds\Image;
use App\Models\Cruds\Invoice;
use App\Models\Cruds\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'status',
        'specialty',
        'department_id',
        'phone',
        'number_of_appointments',
        'password',
        'bio',
    ];

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->withDefault([
            'path' => 'default/doctor.png',
        ]);
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault([
            'name' => __("general.warning.null"),
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

    public function patients()
    {
        // return $this->hasManyThrough(Patient::class, Appointment::class, 'doctor_id', 'id', 'id', 'patient_id');
        return $this->hasManyThrough(Patient::class, Diagnostic::class, 'doctor_id', 'id', 'id', 'patient_id');
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

        static::deleting(function ($doctor) {
            // Delete associated invoices, which will trigger deleting events in Invoice model
            $doctor->invoices->each->delete();
        });
    }
}
