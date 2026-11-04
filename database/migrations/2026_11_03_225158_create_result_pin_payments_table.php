<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('result_pin_payments', function (Blueprint $table) {
            $table->id();

            // Student who made the payment
            $table->foreignId('student_id')
                ->constrained('students')
                ->restrictOnDelete();

            // PIN issued from this payment
            $table->foreignId('result_pin_id')
                ->nullable()
                ->constrained('result_pins')
                ->nullOnDelete();

            // Payment information
            $table->decimal('amount_paid', 12, 2);
            $table->string('currency', 3)->default('NGN');
            $table->string('payment_method', 30);
            $table->string('payment_reference', 100)->unique();

            // Administrator who recorded the payment
            $table->foreignId('recorded_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamp('paid_at');
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['student_id', 'paid_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('result_pin_payments');
    }
};
