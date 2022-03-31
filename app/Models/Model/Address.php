<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'customer_id', 'name', 'country', 'state', 'city', 'phone',
        'zip_code', 'address', 'is_home', 'is_selected'
    ];
}
