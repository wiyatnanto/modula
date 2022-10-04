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
        Schema::create('store_product_variant_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('value_id');
            $table->foreign('value_id')->references('id')->on('store_variant_values');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('store_products')->onDelete('cascade');
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
        Schema::dropIfExists('store_product_variant_values');
    }
};
