<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('route')->nullable()->after('seo_description'); // Pas 'column_name' aan naar de kolom waar je deze na wilt plaatsen
            $table->string('route_title')->nullable()->after('route');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['route', 'route_title']);
        });
    }
};
