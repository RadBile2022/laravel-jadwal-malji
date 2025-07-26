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
        Schema::create('e__masjids', function (Blueprint $table) {
	    $table->id();
	    $table->string('name');
	    $table->text('address');
	    $table->string('map');
	    $table->timestamps();
	    $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e__masjids');
    }
};
