<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_banks', function (Blueprint $table) {
            $table->id();
            $table->string('title','200')->nullable();
            $table->string('caption','1000')->nullable();
            $table->string('tags','1000')->nullable();
            $table->string('image_url');
            $table->string('big_url')->nullable();
            $table->string('medium_url')->nullable();
            $table->string('thumb_url')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('image_banks');
    }
}
