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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('option_type','255')->index();
            $table->string('option_name','255');
            $table->string('option_key','255')->index();
            $table->string('special_option','400');
            $table->text('option_value')->nullable();
            $table->boolean('is_hide')->default('0')->comment("1=>Show,0=>Hide");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
