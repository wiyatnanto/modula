<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crud', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 100)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('note')->nullable();
            $table->string('author', 100)->nullable();
            $table->text('desc')->nullable();
            $table->string('db')->nullable();
            $table->string('db_key', 100)->nullable();
            $table->char('type', 20)->nullable()->default('native');
            $table->longText('config')->nullable();
            $table->text('lang')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crud');
    }
}
