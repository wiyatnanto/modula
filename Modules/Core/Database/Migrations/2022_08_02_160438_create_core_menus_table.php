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
        Schema::create('core_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(NULL);
            $table->string('type')->default(NULL);
            $table->string('url', 255)->default(NULL);
            $table->string('target')->default(NULL);
            $table->string('menu_title', 255)->default(NULL);
            $table->integer('parent_id')->default(0);
            $table->string('sort_order')->default(0);
            $table->string('custom_class')->default(0);
            $table->string('icon')->default(NULL);
            $table->boolean('view')->default(true);
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
        Schema::dropIfExists('core_menus');
    }
};
