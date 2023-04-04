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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('goal_description');
            $table->string('goal_name')->unique();
            $table->integer('program_id');
            $table->string('goal_status'); string?
            $table->integer('number_completed'); number of what? goals?
            $table->integer('goal_year'); ????why
            $table->string('event_type'); ????why
            $table->date('goal_deadline');
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
        Schema::dropIfExists('goals');
    }
};
