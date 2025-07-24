<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('indirizzi', function (Blueprint $table) {
            $table->foreign('CAP')->references('CAP')->on('calendario')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('indirizzi', function (Blueprint $table) {
            $table->dropForeign(['CAP']);
        });
    }
};