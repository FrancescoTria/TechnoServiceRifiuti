<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calendario', function (Blueprint $table) {
            $table->string('CAP', 10);
            $table->string('fascia_oraria_', 50);
            $table->string('lunedì', 50)->nullable();
            $table->string('martedì', 50)->nullable();
            $table->string('mercoledì', 50)->nullable();
            $table->string('giovedì', 50)->nullable();
            $table->string('venerdì', 50)->nullable();
            $table->string('sabato', 50)->nullable();
            $table->string('domenica', 50)->nullable();
            $table->primary(['CAP']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario');
    }
};
