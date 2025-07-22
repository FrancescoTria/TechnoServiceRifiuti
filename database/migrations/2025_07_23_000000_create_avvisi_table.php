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
        Schema::create('avvisi', function (Blueprint $table) {
            $table->id('id_avviso');
            $table->enum('categoria', ['Richiesta', 'Avviso']);
            $table->text('messaggio');
            $table->dateTime('data_invio');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_lavoratore')->nullable();
            $table->enum('oggetto', ['Ritiro rifiuti speciali', 'Invia ticket', 'Supporto tecnico', 'Altro', 'Avviso rifiuto non conforme']);
            $table->foreign('id_cliente')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_lavoratore')->references('id')->on('lavoratori')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avvisi');
    }
};