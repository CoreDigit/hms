<?php

namespace App\Models\Cruds;

use App\Models\Users\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCashClosing extends Model
{
    use HasFactory;

    protected $fillable = [
        'closing_date',
        'opening_balance',
        'total_opd_collected',
        'total_pharmacy_collected',
        'total_ipd_collected',
        'total_expenses',
        'closing_balance',
        'notes',
        'closed_by',
    ];

    public function closedBy()
    {
        return $this->belongsTo(Admin::class, 'closed_by');
    }
}
