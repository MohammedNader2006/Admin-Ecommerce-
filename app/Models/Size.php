<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'name_ar',
'name_en',
'department_id',
'is_public'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
