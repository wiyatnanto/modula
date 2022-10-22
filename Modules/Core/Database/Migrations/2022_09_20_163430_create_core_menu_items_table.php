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
        Schema::create("core_menu_items", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("menu_id");
            $table->foreign("menu_id")->references("id")->on("core_menus");
            $table->unsignedBigInteger("lang_id");
            $table->foreign("lang_id")->references("id")->on("core_languages");
            $table->string("type")->default(null);
            $table->string("url", 255)->default(null);
            $table->string("target")->nullable()->default(null);
            $table->string("menu_title", 255)->default(null);
            $table->integer("parent_id")->default(0);
            $table->integer("sort_order")->default(0);
            $table->string("custom_class")->nullable()->default(null);
            $table->string("icon")->nullable()->default(null);
            $table->boolean("view")->default(true);
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
        Schema::dropIfExists("core_menu_items");
    }
};
