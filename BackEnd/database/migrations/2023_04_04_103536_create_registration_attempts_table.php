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
        Schema::create('registration_attempts', function (Blueprint $table) {
            $table->id();
            $table->time('registration_attempt_time');
            $table->date('registration_attempt_date');
            $table->integer('user_id');
            $table->string('field1')->nullable();
            $table->string('field2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_attempts');
    }
};
