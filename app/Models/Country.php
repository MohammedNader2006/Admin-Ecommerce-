<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country_name_ar',
        'country_name_en',
        'mob',
        'code',
        'currency',
        'logo',
    ];
    public function malls() {
		return $this->hasMany(Mall::class, 'country_id', 'id');
	}
}
