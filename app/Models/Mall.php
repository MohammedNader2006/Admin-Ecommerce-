<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
       protected $fillable = [
        'name_ar',
'name_en',
'facebook',
'twitter',
'website',
'contact_name',
'country_id',
'email',
'address',
'mobile',
'lat',
'lng',
'logo',
    ];

    public function country(){
        return $this->belongsTo(Country::class);
}}

