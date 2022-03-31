<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'shop_name', 'photo'
    ];
}
