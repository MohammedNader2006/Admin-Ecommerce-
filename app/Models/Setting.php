<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'sitname_ar',
        'sitname_en',
        'logo',
        'icon',
        'email',
        'main_lang',
        'description',
        'keywords',
        'status',
        'message_maintenance',
    ];
}
