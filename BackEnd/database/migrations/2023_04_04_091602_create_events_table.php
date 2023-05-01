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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_main_picture')->nullable();
            $table->string('event_description');
            $table->string('event_location');
            $table->string('branch_id');
            $table->date('event_date');
            $table->string('event_title');
            $table->integer('event_type_id');
            $table->integer('program_id');
            $table->string('budget_sheet')->nullable();
            $table->string('proposal')->nullable();
            $table->string('meeting_minute')->nullable();
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
        Schema::dropIfExists('events');
    }
};
