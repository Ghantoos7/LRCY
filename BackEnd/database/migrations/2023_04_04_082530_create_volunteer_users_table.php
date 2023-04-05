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
        Schema::create('volunteer_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer("organization_id")->unique();
            $table->integer("gender");
            $table->integer("user_type_id");
            $table->integer('user_age');
            $table->string('user_position');
            $table->boolean('is_registered');
            $table->boolean('is_active');
            $table->integer('branch_id');
            $table->string('user_profile_pic')->nullable();
            $table->date('user_end_date')->nullable();
            $table->date('user_start_date');
            $table->string('password');
            $table->string('username');
            $table->string('user_bio')->nullable();
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
        Schema::dropIfExists('users');
    }
};
