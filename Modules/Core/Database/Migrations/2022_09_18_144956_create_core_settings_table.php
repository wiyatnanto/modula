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
        Schema::create('core_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_name')->default(NULL);
            $table->string('setting_key')->unique();
            $table->enum('setting_type', ['select', 'radio', 'text', 'text_area']);
            $table->string('setting_type_options')->nullable()->default(null);
            $table->string('setting_value')->nullable()->default(null);
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
        Schema::dropIfExists('core_settings');
    }
};
