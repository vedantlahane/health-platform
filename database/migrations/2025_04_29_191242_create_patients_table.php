<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // for external reference
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('dob');
            $table->string('gender');
            $table->string('blood_group')->nullable();
            $table->text('address')->nullable();
            $table->text('allergies')->nullable();
            $table->text('medications')->nullable();
            $table->text('family_history')->nullable();
            $table->text('social_history')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('insurance')->nullable();
            $table->text('medical_history')->nullable();
            $table->string('status')->default('active'); // active, inactive, deceased
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name']);
            $table->index(['email']);
            $table->index(['phone']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
