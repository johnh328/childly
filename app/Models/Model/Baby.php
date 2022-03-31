<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Baby extends Model
{
    protected $fillable = [
        'baby_name', 'gender', 'dob', 'image_url', 'parent_name'
    ];
}
