<?php

namespace App\Models\Web;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    use Translatable;

    public $fillable = ['category'];
    public $translatedAttributes = ['question', 'answer'];

    public function translations()
    {
        return $this->hasMany(FaqTranslation::class);
    }
}
