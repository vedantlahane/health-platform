<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('billings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        $table->string('invoice_number')->unique();
        $table->json('items'); // Array of billed items/services
        $table->decimal('subtotal', 10, 2);
        $table->decimal('tax', 10, 2)->default(0);
        $table->decimal('discount', 10, 2)->default(0);
        $table->decimal('total', 10, 2);
        $table->string('status')->default('unpaid');
        $table->string('payment_method')->nullable();
        $table->date('paid_at')->nullable();
        $table->date('due_date');
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
