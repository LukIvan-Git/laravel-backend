<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMail extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    public function setMessageAttribute($value)
    {
        $cleaned = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        $this->attributes['message'] = $cleaned;
    }
}
