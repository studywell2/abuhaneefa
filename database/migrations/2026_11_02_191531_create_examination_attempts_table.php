<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('examination_attempts', function (Blueprint $table) {
            $table->id();

            // Student taking the examination
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            // Examination being attempted
            $table->foreignId('examination_id')
                ->constrained('examinations')
                ->cascadeOnDelete();

            // Examination timing
            $table->dateTime('started_at');
            $table->dateTime('submitted_at')->nullable();

            // Attempt status
            $table->string('status', 20)->default('in_progress');

            // Prevent duplicate attempts
            $table->unique(
                ['student_id', 'examination_id'],
                'unique_student_examination_attempt'
            );

            $table->timestamps();

            $table->index(['examination_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examination_attempts');
    }
};
