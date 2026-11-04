<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('result_pins', function (Blueprint $table) {
            $table->id();

            // Student who owns this PIN
            $table->foreignId('student_id')
                ->constrained('students')
                ->restrictOnDelete();

            // Store only the hashed PIN, never the plain PIN
            $table->string('pin_hash', 255)->unique();

            // First academic period
            $table->string('start_academic_year', 20);
            $table->string('start_term', 20);

            // Second consecutive academic period
            $table->string('end_academic_year', 20);
            $table->string('end_term', 20);

            // Administrator who issued the PIN
            $table->foreignId('issued_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamp('issued_at');

            // PIN status and revocation information
            $table->string('status', 20)->default('active');
            $table->foreignId('revoked_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('revoked_at')->nullable();
            $table->string('revocation_reason', 500)->nullable();

            $table->timestamps();

            $table->index(['student_id', 'status']);
            $table->index(
                ['start_academic_year', 'start_term', 'end_academic_year', 'end_term'],
                'result_pins_period_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('result_pins');
    }
};
