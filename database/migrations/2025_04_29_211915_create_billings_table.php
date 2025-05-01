<?php
// database/migrations/2023_01_01_000001_create_billings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');
            $table->string('invoice_number')->unique();
            $table->json('items');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('payment_method')->nullable();
            $table->dateTime('paid_at');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['patient_id']);
            $table->index(['appointment_id']);
            $table->index(['invoice_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('billings');
    }
};
