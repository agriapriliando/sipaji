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
        Schema::create('delegations', function (Blueprint $table) {
            // UUID sebagai primary key
            $table->uuid('id')->primary();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('nomor_porsi', 100)->index();
            $table->string('nama_asal', 150);
            $table->string('bin_binti_asal', 150)->nullable();
            $table->string('nama_penerima', 150);
            $table->string('bin_binti_penerima', 150)->nullable();

            $table->string('jenis_kelamin', 20);
            $table->string('ttl_tempat', 120);
            $table->date('ttl_tanggal');

            $table->string('pekerjaan', 150)->nullable();
            $table->text('alamat');
            $table->string('nomor_hp', 30)->nullable();

            $table->string('alasan_pelimpahan', 255)->nullable();

            $table->boolean('status_surveys')->default(false);

            $table->string('jenis_persyaratan', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegations');
    }
};
