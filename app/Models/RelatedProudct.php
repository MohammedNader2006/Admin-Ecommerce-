<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedProudct extends Model
{
    protected $fillable = [
        'product_id',
        'related_product',

    ];
    public function product() {
		return $this->hasOne(\App\Models\Product::class , 'related_product', 'id');
	}
}
