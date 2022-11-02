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
        Schema::create('blog_pages', function (Blueprint $table) {
            $table->id();
            $table->string("title",255);
            $table->text("content");
            $table->text("slug");
            $table->string("caption",191)->nullable();
            $table->string("type",10)->default('default');
            $table->string('lang', 2)->default('id');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('auth_users')->onDelete('RESTRICT')->onUpdate('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_pages');
    }
};
