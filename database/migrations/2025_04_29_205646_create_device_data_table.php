<?php
// database/migrations/2023_01_01_000002_create_device_data_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('device_data', function (Blueprint $table) {
        $table->id();
        $table->uuid('uuid')->unique();
        $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');
        $table->string('device_type');
        $table->json('data');
        $table->string('unit')->nullable();
        $table->dateTime('recorded_at');
        $table->text('notes')->nullable();
        $table->boolean('is_billable')->default(false);
        $table->boolean('billed')->default(false);
        $table->unsignedBigInteger('billed_in_invoice_id')->nullable(); // Don't add constraint yet

        $table->timestamps();
        $table->softDeletes();

        $table->index(['patient_id', 'device_type']);
        $table->index(['appointment_id']);
        $table->index(['recorded_at']);
    });
    
    // Add the foreign key constraint after ensuring the billings table exists
    if (Schema::hasTable('billings')) {
        Schema::table('device_data', function (Blueprint $table) {
            $table->foreign('billed_in_invoice_id')->references('id')->on('billings')->onDelete('set null');
        });
    }
}


    public function down()
    {
        Schema::dropIfExists('device_data');
    }
};
