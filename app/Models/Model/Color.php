<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'color_name', 'color_hex'
    ];
}
