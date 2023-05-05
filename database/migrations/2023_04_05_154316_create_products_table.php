<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('product_name');
            $table->string('product_sku');
            $table->double('product_price');
            $table->double('product_old_price')->nullable();
            $table->boolean('product_status')->nullable();
            $table->integer('product_qty');
            $table->double('product_discount')->nullable();
            $table->double('product_weight')->nullable();
            $table->string('product_image')->nullable();
            $table->text('product_description')->nullable();
            $table->text('product_short_description')->nullable();
            $table->string('product_label')->nullable();
            $table->boolean('product_feature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
