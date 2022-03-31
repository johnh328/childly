<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'sub_category_name', 'category_id', 'sub_category_id'
    ];
}
