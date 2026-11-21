<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'dep_name_ar',
        'dep_name_en',
        'icon',
        'description',
        'keyword',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(
            Department::class,
            'parent_id'
        );
    }

    public function children()
    {
        return $this->hasMany(
            Department::class,
            'parent_id'
        );
    }
}
