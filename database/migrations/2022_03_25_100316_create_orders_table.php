<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('product_id');
            $table->string('order_id');
            $table->json('address');
            $table->string('product_name');
            $table->string('product_thumbnail');
            $table->string('product_price');
            $table->string('product_code');
            $table->string('product_amount');
            $table->string('total_price');
            $table->string('payment_status');
            $table->string('tracking_id');
            $table->string('invoice_id');
            $table->string('online_payment_id')->nullable();
            $table->string('payment_mode');
            $table->string('tracking_status');
            $table->string('is_cancelled');
            $table->string('refundable_date')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_attribute')->nullable();
            $table->string('product_attribute_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
