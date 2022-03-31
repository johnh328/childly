<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->String('product_name');
            $table->String('product_code');
            $table->String('category_id');
            $table->String('sub_category_id');
            $table->String('supplier_id');
            $table->String('product_price');
            $table->String('selling_price');
            $table->String('free_shipping');
            $table->String('refundable');
            $table->String('cash_on_delivery');
            $table->text('product_description');
            $table->text('product_more_info');
            $table->String('thumbnail_image');
            $table->String('product_quantity');
            $table->String('brand_name')->nullable();
            $table->String('delivery_charge')->nullable();
            $table->text('return_detail')->nullable();
            $table->json('product_images');
            $table->json('product_attribute_value')->nullable();
            $table->String('product_attribute')->nullable();
            $table->String('refundable_day')->nullable();
            $table->json('product_color')->nullable();
            $table->String('product_review')->nullable();
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
        Schema::dropIfExists('products');
    }
}
