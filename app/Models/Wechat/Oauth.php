<?php

namespace App\Models\Wechat;

use Illuminate\Database\Eloquent\Model;

class Oauth extends Model
{
    protected $defaultSorting = ['id' => 'ASC'];

    protected $fillable = [
        'open_id',
        'session_id',
    ];

}
