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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->unsignedBigInteger('time_id')->nullable();
            $table->string('time')->nullable();
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->string('topic')->nullable();
            $table->unsignedBigInteger('speaker_id')->nullable();
            $table->string('speaker')->nullable();
            $table->unsignedBigInteger('place_id')->nullable();
            $table->string('place')->nullable();
	    $table->boolean('is_free');
            $table->text('information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
