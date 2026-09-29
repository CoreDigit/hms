<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiServiceTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function multiService()
    {
        return $this->belongsTo(MultiService::class);
    }
}
