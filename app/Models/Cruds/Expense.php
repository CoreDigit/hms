<?php

namespace App\Models\Cruds;

use App\Models\Users\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_category_id',
        'title',
        'amount',
        'expense_date',
        'payment_mode',
        'vendor_name',
        'reference_no',
        'description',
        'recorded_by',
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function recorder()
    {
        return $this->belongsTo(Admin::class, 'recorded_by');
    }
}
