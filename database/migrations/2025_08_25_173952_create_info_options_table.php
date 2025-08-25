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
        Schema::create('info_options', function (Blueprint $table) {
            $table->id();
            $table->string('judul_informasi');
            $table->text('isi_informasi')->nullable();
            $table->string('tipe_informasi', 20)->default('informasi');
            $table->string('gambar', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_options');
    }
};
