<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('examination_results', function (Blueprint $table) {
            $table->id();

            // One result belongs to one examination attempt
            $table->foreignId('examination_attempt_id')
                ->unique()
                ->constrained('examination_attempts')
                ->cascadeOnDelete();

            // Calculated marks
            $table->unsignedInteger('marks_obtained')->default(0);
            $table->unsignedInteger('total_marks');

            $table->decimal('percentage', 5, 2)->default(0);

            // Pass or fail
            $table->string('outcome', 20);

            // Result approval workflow
            $table->string('status', 30)->default('pending_review');

            // Examiner who reviews the result
            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Administrator who approves the result
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->dateTime('reviewed_at')->nullable();
            $table->dateTime('approved_at')->nullable();

            // Review or approval comments
            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examination_results');
    }
};
