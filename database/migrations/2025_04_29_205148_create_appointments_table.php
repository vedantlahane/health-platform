<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->string('specialization')->nullable();
            $table->dateTime('appointment_time');
            $table->string('status')->default('scheduled'); // scheduled, completed, cancelled
            $table->string('type')->nullable(); // consultation, follow-up, procedure
            $table->string('reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['doctor_id', 'appointment_time']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
