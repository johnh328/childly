<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id', 'customer_id', 'product_name', 'product_thumbnail',
        'product_price', 'product_code', 'product_amount',
        'total_price', 'tracking_id', 'invoice_id', 'is_cancelled',
        'payment_mode', 'tracking_status', 'refundable_date', 'payment_status',
        'online_payment_id', 'order_id', 'product_color', 'product_attribute', 'product_attribute_value'
    ];
}
