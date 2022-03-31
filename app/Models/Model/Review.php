<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'customer_id', 'product_id', 'rating', 'review'
    ];
}
