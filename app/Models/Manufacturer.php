<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'name_ar',
'name_en',
'facebook',
'twitter',
'website',
'contact_name',
'email',
'address',
'mobile',
'lat',
'lng',
'logo',
    ];
}
