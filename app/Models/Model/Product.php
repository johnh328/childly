<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_code', 'category_id', 'sub_category_id', 'supplier_id',
        'buying_price', 'selling_price', 'free_shipping', 'refundable', 'cash_on_delivery',
        'product_description', 'thumbnail_image', 'product_images', 'product_quantity', 'product_attribute',
        'product_attribute_value', 'product_color', 'product_review', 'refundable_date', 'brand_name', 'return_detail'
    ];

    protected $casts = [
        'product_images' => 'array',
        'product_attribute_value' => 'array',
        'product_color' => 'array'
    ];
}
