<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); // Voor created_at en updated_at
            $table->timestamp('datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('name')->nullable(); // Naam van de actie
            $table->string('action'); // Type actie (bijv. 'created', 'updated', etc.)
            $table->string('type')->nullable(); // Type van audit (bijv. 'system', 'user')
            $table->string('model')->nullable(); // Modelnaam
            $table->unsignedBigInteger('model_id')->nullable(); // Model ID
            $table->unsignedBigInteger('user_id')->nullable(); // Gebruiker ID
            $table->unsignedBigInteger('staff_id')->nullable(); // Staff ID
            $table->string('title')->nullable(); // Titel voor een audit log
            $table->text('comment')->nullable(); // Eventuele opmerkingen
            $table->text('error')->nullable(); // Eventuele foutmeldingen
            $table->string('ip')->nullable(); // 
            $table->index(['model', 'model_id']);
            $table->index('user_id');
            $table->index('staff_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
