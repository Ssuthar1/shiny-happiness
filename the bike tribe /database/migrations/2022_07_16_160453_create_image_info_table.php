<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_infos', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['tour', 'tour_category','destination','destination_category','post','category','page'])->nullable();
            $table->enum('image_position', ['main_image', 'gallery_image','banner_image'])->nullable();
            $table->unsignedBigInteger('property_id')->nullable();  
            $table->unsignedBigInteger('image_bank_id')->nullable();  
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
        Schema::dropIfExists('image_info');
    }
}
