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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('sub_title',255)->nullable();
            $table->string('image',255);
            $table->mediumText('description')->nullable();
            $table->string('link_text',255)->nullable();
            $table->string('link_url',255)->nullable();
            $table->enum('banner_location', ['Main Banner', 'Home Middle Small Banner','Home Bottom Banner']);
            $table->boolean('status')->default(0)->comment('0:Active, 1:Inactive');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
