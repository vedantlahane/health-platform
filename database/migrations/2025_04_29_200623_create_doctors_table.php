<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();
            $table->string('department')->nullable();
            $table->string('profile_photo')->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->integer('experience')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('room_number')->nullable();
            $table->string('timing')->nullable();
            $table->decimal('consultation_fee', 8, 2)->nullable();
            $table->text('bio')->nullable();
            $table->string('license_number')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->string('status')->default('active'); // active, inactive, retired, etc.
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name']);
            $table->index(['email']);
            $table->index(['specialization']);
            $table->index(['department']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
