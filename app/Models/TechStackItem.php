<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TechStackItem extends Model
{
    protected $fillable = [
        'name',
        'icon_path',
        'details',
    ];

    protected $casts = [
        'details' => 'json',
    ];
}
