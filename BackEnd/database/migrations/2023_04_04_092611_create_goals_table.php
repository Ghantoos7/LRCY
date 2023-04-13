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
            $table->string('goal_name');
            $table->integer('program_id');
            $table->boolean('goal_status');
            $table->integer('number_completed');
            $table->integer('number_to_complete');
            $table->integer('goal_year');
            $table->integer('event_type_id');
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
