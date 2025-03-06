<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('template')->nullable();
            $table->string('description')->nullable()->after('sort');
            $table->string('title_4')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('template');
            $table->dropColumn('description');
            $table->dropColumn('title_4');
        });
    }
};
