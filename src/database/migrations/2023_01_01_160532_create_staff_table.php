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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('host')->nullable();
            $table->integer('pid')->nullable();
            $table->string('locale')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('sort')->default(1);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->dateTime('lastLogin')->nullable();
            $table->string('code')->nullable();
            $table->tinyInteger('admin')->default(0);
            $table->tinyInteger('developer')->default(0);
            $table->text('comments')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
