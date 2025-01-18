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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->string('country_code');
            $table->longText('country_flag');
            $table->longText('geojson');
            $table->timestamps();
        });
        Schema::create('aquaculture_production', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('aquaculture_production_2020')->nullable();
            $table->integer('aquaculture_production_2021')->nullable();
            $table->integer('aquaculture_production_2022')->nullable();
            $table->timestamps();
            
        });
        Schema::create('total_fisheries_production', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('total_fisheries_production_2020')->nullable();
            $table->integer('total_fisheries_production_2021')->nullable();
            $table->integer('total_fisheries_production_2022')->nullable();
            $table->timestamps();
        });
        Schema::create('capture_fisheries_production', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('capture_fisheries_production_2020')->nullable();
            $table->integer('capture_fisheries_production_2021')->nullable();
            $table->integer('capture_fisheries_production_2022')->nullable();
            $table->timestamps();
        });
        Schema::create('marine_protected_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('marine_protected_areas_2020')->nullable();
            $table->float('marine_protected_areas_2021')->nullable();
            $table->float('marine_protected_areas_2022')->nullable();
            $table->text('polygon_data_json')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
