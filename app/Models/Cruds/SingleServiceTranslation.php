<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleServiceTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function singleService()
    {
        return $this->belongsTo(SingleService::class);
    }
}
