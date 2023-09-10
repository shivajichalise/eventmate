<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->string('number')->unique()->nullable();
            $table->timestamp('issued_date')->useCurrent();
            $table->date('due_date')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('service_charge', 10, 2)->nullable()->default(0.00);
            $table->decimal('delivery_charge', 10, 2)->nullable()->default(0.00);
            $table->decimal('discount', 10, 2)->nullable()->default(0.00);
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
