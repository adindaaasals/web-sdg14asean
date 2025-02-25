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
        // Menambahkan kolom untuk tabel aquaculture_production
        Schema::table('aquaculture_production', function (Blueprint $table) {
            $table->integer('aquaculture_production_2023')->nullable();
            $table->integer('aquaculture_production_2024')->nullable();
            $table->integer('aquaculture_production_2025')->nullable();
        });

        // Menambahkan kolom untuk tabel capture_fisheries_production
        Schema::table('capture_fisheries_production', function (Blueprint $table) {
            $table->integer('capture_fisheries_production_2023')->nullable();
            $table->integer('capture_fisheries_production_2024')->nullable();
            $table->integer('capture_fisheries_production_2025')->nullable();
        });

        // Menambahkan kolom untuk tabel marine_protected_areas
        Schema::table('marine_protected_areas', function (Blueprint $table) {
            $table->float('marine_protected_areas_2023')->nullable();
            $table->float('marine_protected_areas_2024')->nullable();
            $table->float('marine_protected_areas_2025')->nullable();
        });

        // Menambahkan kolom untuk tabel total_fisheries_production
        Schema::table('total_fisheries_production', function (Blueprint $table) {
            $table->integer('total_fisheries_production_2023')->nullable();
            $table->integer('total_fisheries_production_2024')->nullable();
            $table->integer('total_fisheries_production_2025')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom yang ditambahkan pada tabel aquaculture_production
        Schema::table('aquaculture_production', function (Blueprint $table) {
            $table->dropColumn(['aquaculture_production_2023', 'aquaculture_production_2024', 'aquaculture_production_2025']);
        });

        // Menghapus kolom yang ditambahkan pada tabel capture_fisheries_production
        Schema::table('capture_fisheries_production', function (Blueprint $table) {
            $table->dropColumn(['capture_fisheries_production_2023', 'capture_fisheries_production_2024', 'capture_fisheries_production_2025']);
        });

        // Menghapus kolom yang ditambahkan pada tabel marine_protected_areas
        Schema::table('marine_protected_areas', function (Blueprint $table) {
            $table->dropColumn(['marine_protected_areas_2023', 'marine_protected_areas_2024', 'marine_protected_areas_2025']);
        });

        // Menghapus kolom yang ditambahkan pada tabel total_fisheries_production
        Schema::table('total_fisheries_production', function (Blueprint $table) {
            $table->dropColumn(['total_fisheries_production_2023', 'total_fisheries_production_2024', 'total_fisheries_production_2025']);
        });
    }
};
