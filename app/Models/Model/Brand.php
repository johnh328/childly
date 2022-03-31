<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name', 'logo_url'
    ];
}
