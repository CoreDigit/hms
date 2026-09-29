<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
