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
        Schema::table('staff', function (Blueprint $table) {
            $table->string('speed')->nullable(); // Pas 'existing_column' aan naar een bestaande kolom
            $table->string('speed_ip', 45)->nullable()->after('speed'); // IPv6-adressen kunnen maximaal 45 tekens lang zijn
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn(['speed', 'speed_ip']);
        });
    }
};
