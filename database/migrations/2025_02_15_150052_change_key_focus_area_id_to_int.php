<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus foreign key sebelum mengubah tipe data country_id
        Schema::table('aquaculture_production', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('capture_fisheries_production', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('marine_protected_areas', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('total_fisheries_production', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });

        // Ubah tipe data id di tabel countries menjadi INT UNSIGNED AUTO_INCREMENT
        DB::statement('ALTER TABLE countries MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT');

        // Ubah tipe data id di tabel key focus area menjadi INT UNSIGNED AUTO_INCREMENT
        DB::statement('ALTER TABLE aquaculture_production MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE capture_fisheries_production MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE marine_protected_areas MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE total_fisheries_production MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT');

        // Ubah tipe data country_id agar sesuai dengan id di tabel countries
        DB::statement('ALTER TABLE aquaculture_production MODIFY country_id INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE capture_fisheries_production MODIFY country_id INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE marine_protected_areas MODIFY country_id INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE total_fisheries_production MODIFY country_id INT UNSIGNED NOT NULL');

        // Ubah tipe data country_name menjadi VARCHAR(50)
        DB::statement('ALTER TABLE countries MODIFY country_name VARCHAR(50) NOT NULL');

        // Ubah tipe data country_code menjadi VARCHAR(3)
        DB::statement('ALTER TABLE countries MODIFY country_code VARCHAR(3) NOT NULL');

        // Tambahkan kembali foreign key setelah perubahan selesai
        Schema::table('aquaculture_production', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('capture_fisheries_production', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('marine_protected_areas', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('total_fisheries_production', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });

        // Ubah tipe data name dan email di tabel users menjadi VARCHAR(50)
        DB::statement('ALTER TABLE users MODIFY name VARCHAR(50) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY email VARCHAR(50) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key sebelum rollback
        Schema::table('aquaculture_production', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('capture_fisheries_production', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('marine_protected_areas', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('total_fisheries_production', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });

        // Kembalikan tipe data id di tabel countries menjadi BIGINT UNSIGNED AUTO_INCREMENT jika rollback
        DB::statement('ALTER TABLE countries MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');

        // Kembalikan tipe data id di tabel key focus area ke BIGINT UNSIGNED AUTO_INCREMENT jika rollback
        DB::statement('ALTER TABLE aquaculture_production MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE capture_fisheries_production MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE marine_protected_areas MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE total_fisheries_production MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');

        // Kembalikan tipe data country_id ke BIGINT UNSIGNED agar sesuai dengan default sebelumnya
        DB::statement('ALTER TABLE aquaculture_production MODIFY country_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE capture_fisheries_production MODIFY country_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE marine_protected_areas MODIFY country_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE total_fisheries_production MODIFY country_id BIGINT UNSIGNED NOT NULL');

        // Kembalikan tipe data country_name menjadi VARCHAR(255)
        DB::statement('ALTER TABLE countries MODIFY country_name VARCHAR(255) NOT NULL');

        // Kembalikan tipe data country_code menjadi VARCHAR(255)
        DB::statement('ALTER TABLE countries MODIFY country_code VARCHAR(255) NOT NULL');

        // Tambahkan kembali foreign key setelah rollback selesai
        Schema::table('aquaculture_production', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('capture_fisheries_production', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('marine_protected_areas', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('total_fisheries_production', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });

        // Kembalikan tipe data name dan email di tabel users ke VARCHAR(255)
        DB::statement('ALTER TABLE users MODIFY name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY email VARCHAR(255) NOT NULL');
    }
};
