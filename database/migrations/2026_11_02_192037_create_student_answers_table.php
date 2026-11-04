<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();

            // The student's examination attempt
            $table->foreignId('examination_attempt_id')
                ->constrained('examination_attempts')
                ->cascadeOnDelete();

            // The question being answered
            $table->foreignId('examination_question_id')
                ->constrained('examination_questions')
                ->cascadeOnDelete();

            // Selected answer: A, B, C or D
            $table->string('selected_option', 1)->nullable();

            // Prevent duplicate answers for the same question
            $table->unique(
                ['examination_attempt_id', 'examination_question_id'],
                'unique_attempt_question_answer'
            );

            $table->timestamps();

            $table->index('examination_question_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
