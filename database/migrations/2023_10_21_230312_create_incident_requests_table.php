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
        Schema::create('incident_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('caller');
            $table->dateTime('opened');
            $table->string('opened_by');
            $table->string('location');
            $table->string('impacted_item');
            $table->string('category');
            $table->string('priority');
            $table->text('short_description');
            $table->text('description');
            $table->string('incident_state')->default('Pending');
            $table->foreignId('user_id')->on('users');
            $table->foreignId('it_personnel_id')->on('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_requests');
    }
};
