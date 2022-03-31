<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_title', 'blog_category_name', 'blog_image_url', 'blog_description', 'blog_status'
    ];
}
