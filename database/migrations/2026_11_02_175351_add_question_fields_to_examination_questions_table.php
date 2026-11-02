<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('examination_questions', function (Blueprint $table) {
            $table->foreignId('examination_id')
                ->after('id')
                ->constrained('examinations')
                ->cascadeOnDelete();

            $table->longText('question_text');
            $table->text('option_a');
            $table->text('option_b');
            $table->text('option_c');
            $table->text('option_d');
            $table->string('correct_option', 1);
            $table->unsignedInteger('marks')->default(1);
            $table->unsignedInteger('question_order')->default(1);

            $table->index(['examination_id', 'question_order']);
        });
    }

    public function down(): void
    {
        Schema::table('examination_questions', function (Blueprint $table) {
            $table->dropIndex(['examination_id', 'question_order']);
            $table->dropConstrainedForeignId('examination_id');

            $table->dropColumn([
                'question_text',
                'option_a',
                'option_b',
                'option_c',
                'option_d',
                'correct_option',
                'marks',
                'question_order',
            ]);
        });
    }
};
