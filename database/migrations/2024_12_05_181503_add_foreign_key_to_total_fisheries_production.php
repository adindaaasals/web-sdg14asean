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
        Schema::table('total_fisheries_production', function (Blueprint $table) {
            $table->foreign('country_code')
              ->references('country_code')
              ->on('countries')
              ->onDelete('cascade'); // Atur onDelete sesuai kebutuhan Anda
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('total_fisheries_production', function (Blueprint $table) {
            $table->dropForeign(['country_code']);
        });
    }
};
