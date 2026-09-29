<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
