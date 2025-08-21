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
        Schema::create('cancels', function (Blueprint $table) {
            // UUID primary key
            $table->uuid('id')->primary();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('nomor_porsi', 100)->index();
            $table->string('nama', 150);
            $table->string('bin_binti', 150)->nullable();

            $table->string('ttl_tempat', 120);
            $table->date('ttl_tanggal');

            $table->string('pekerjaan', 150)->nullable();
            $table->text('alamat');

            $table->text('alasan_pembatalan')->nullable();

            $table->boolean('status_surveys')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancels');
    }
};
