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
        Schema::create('indirizzi', function (Blueprint $table) {
            $table->bigIncrements('id_indirizzo');
            $table->string('tipo_indirizzo', 50)->nullable();
            $table->string('nome_indirizzo', 255);
            $table->string('civico', 20)->nullable();
            $table->string('CAP', 10)->nullable();
            $table->foreign('CAP')->references('CAP')->on('calendario')->onDelete('set null');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_indirizzo')->nullable()->after('id');
            $table->foreign('id_indirizzo')->references('id_indirizzo')->on('indirizzi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_indirizzo']);
            $table->dropColumn('id_indirizzo');
        });
        Schema::dropIfExists('indirizzi');
    }
};