<?php

namespace App\Models\Cruds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_type',
        'recipient_id',
        'title',
        'message',
        'type',
        'link',
        'is_read',
    ];
}
