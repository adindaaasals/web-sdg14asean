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
        Schema::create('capture_fisheries_production', function (Blueprint $table) {
            $table->id();
            $table->string('country_code'); 
            $table->string('country_name'); 
            $table->float('year_2020')->nullable(); 
            $table->float('year_2021')->nullable(); 
            $table->float('year_2022')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capture_fisheries_production');
    }
};
