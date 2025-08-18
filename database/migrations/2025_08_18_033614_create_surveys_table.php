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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();

            // Polymorphic relation
            $table->string('target_type'); // Model class (ex: App\Models\Cancel)
            $table->uuid('target_id'); // ID dari model target

            $table->string('kepuasan', 50); // contoh: "puas" / "tidak puas"

            $table->timestamps();

            $table->index(['target_type', 'target_id']); // untuk performa morph relation
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
