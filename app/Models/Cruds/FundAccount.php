<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'case', 'transaction_type', 'transaction_id'];

    public function scopeFindByTransaction($query, $type, $id)
    {
        return $query->where('transaction_type', $type)->where('transaction_id', $id)->first();
    }

    public function transaction()
    {
        return match ($this->transaction_type) {
            'payment' => Payment::find($this->transaction_id),
            'receipt' => Receipt::find($this->transaction_id),
            'invoice' => Invoice::find($this->transaction_id),
        };
    }

}
