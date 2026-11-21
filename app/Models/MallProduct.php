<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MallProduct extends Model
{
       protected $fillable = [
		'product_id',
		'mall_id',

	];
    public function mall(){
        return $this->hasOne(Mall::class,'id','mall_id');
    }
}
