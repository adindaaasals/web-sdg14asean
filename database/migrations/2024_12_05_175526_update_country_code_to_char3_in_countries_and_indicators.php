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
        Schema::table('countries', function (Blueprint $table) {
            $table->string('country_code', 3)->change(); // Menambahkan char(3)
        });
    
        Schema::table('aquaculture_production', function (Blueprint $table) {
            $table->string('country_code', 3)->change(); // Menambahkan char(3)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('country_code')->change(); // Kembalikan ke string jika rollback
        });
    
        Schema::table('aquaculture_production', function (Blueprint $table) {
            $table->string('country_code')->change(); // Kembalikan ke string jika rollback
        });
    }
};
