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
        Schema::table('maps', function (Blueprint $table) {
            // Pertama tambahkan kolom 'country_code'
            $table->string('country_code', 3); // Sesuaikan dengan tipe data di tabel countries

            // Kemudian tambahkan foreign key
            $table->foreign('country_code')
                  ->references('country_code')
                  ->on('countries')
                  ->onDelete('cascade'); // Atur onDelete sesuai kebutuhan Anda
        });

        // Kemudian baru hapus kolom country_id setelah foreign key berhasil ditambahkan
        Schema::table('maps', function (Blueprint $table) {
            $table->dropColumn('country_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maps', function (Blueprint $table) {
            // Jika rollback, hapus foreign key dan kolom country_code
            $table->dropForeign(['country_code']);
            $table->dropColumn('country_code');

            // Jika ingin menambah kembali country_id
            $table->integer('country_id')->unsigned();  // Sesuaikan tipe data jika perlu
        });
    }
};
