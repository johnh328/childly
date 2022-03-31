<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'attribute_name', 'attribute_id'
    ];
}
