<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('value_id');
            $table->foreign('value_id')->references('id')->on('store_attribute_values');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('store_products')->onDelete('cascade');
            $table->string('sku');
            $table->integer('quantity');
            $table->decimal('price', 12, 2)->nullable();
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
        Schema::dropIfExists('store_product_attribute_values');
    }
};
