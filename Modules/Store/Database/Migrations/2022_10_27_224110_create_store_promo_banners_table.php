<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("store_promo_banners", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("title")->nullable();
            $table->string("sub_title")->nullable();
            $table->string("note")->nullable();
            $table->string("image")->nullable();
            $table->string("url", 255)->default(null);
            $table->string("button_text")->default(null);
            $table->string("discount_text")->default(null);
            $table->string("sort_order")->default(0);
            $table->integer("layout")->default(0);
            $table->boolean("status")->default(1);
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
        Schema::dropIfExists("store_promo_banners");
    }
};
