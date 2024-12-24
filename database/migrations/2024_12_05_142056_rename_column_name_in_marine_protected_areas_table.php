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
        Schema::table('marine_protected_areas', function (Blueprint $table) {
            $table->renameColumn('year_2020', 'marine_protected_areas_2020');
            $table->renameColumn('year_2021', 'marine_protected_areas_2021');
            $table->renameColumn('year_2022', 'marine_protected_areas_2022');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marine_protected_areas', function (Blueprint $table) {
            $table->renameColumn('marine_protected_areas_2020', 'year_2020');
            $table->renameColumn('marine_protected_areas_2021', 'year_2021');
            $table->renameColumn('marine_protected_areas_2022', 'year_2022');
        });
    }
};
