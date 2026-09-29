<?php

namespace App\Models\Cruds;

use App\Models\Cruds\MultiService;
use App\Models\Cruds\SingleService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'price', 'status'];
    public $timestamps = false;

    public function singleService()
    {
        return $this->hasOne(SingleService::class);
    }

    public function multiService()
    {
        return $this->hasOne(MultiService::class);
    }

    public function getNameAttribute()
    {
        return $this->type === 'single' ? $this->singleService->name : $this->multiService->name;
    }

    public function getDescriptionAttribute()
    {
        return $this->type === 'single' ? $this->singleService->description : $this->multiService->description;
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

        static::deleting(function ($service) {
            // Delete associated invoices, which will trigger deleting events in Invoice model
            $service->invoices->each->delete();
        });
    }
}
