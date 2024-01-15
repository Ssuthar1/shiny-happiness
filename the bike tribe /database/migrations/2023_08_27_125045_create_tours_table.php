<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_tag_keywords')->nullable();
            $table->string('meta_tag_descriptions')->nullable();
            $table->string('short_description')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('tour_code')->nullable();
            $table->string('destinations',1000)->nullable();
            $table->string('tour_duration')->nullable();
            $table->longText('itineraries')->nullable();
            $table->longText('included')->nullable();
            $table->longText('excluded')->nullable();
            $table->decimal('start_price', 10, 2)->nullable();
            $table->boolean('tour_type')->comment('1: Single Day Tour, 2: Multi Day Tour')->default('1')->nullable();
            $table->boolean('status')->comment('0','1')->default('1')->nullable();
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
