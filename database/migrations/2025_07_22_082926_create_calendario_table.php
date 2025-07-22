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
            $table->string('giorno');
            $table->string('rifiuto');
            $table->time('fascia_oraria')->nullable();
        });

        // Creo la tabella lavoratori
        Schema::create('lavoratori', function (Blueprint $table) {
            $table->id('id_lavoratore');
            $table->string('nome');
            $table->string('cognome');
            $table->boolean('admin')->default(false);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario');
        Schema::dropIfExists('lavoratori');
    }
};
