<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer'];
    public $timestamps = false;
    
    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
