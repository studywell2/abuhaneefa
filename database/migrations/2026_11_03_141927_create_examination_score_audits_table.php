<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('examination_score_audits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('examination_result_id')
                ->constrained('examination_results')
                ->cascadeOnDelete();

            $table->foreignId('entered_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('component', 30);

            $table->integer('old_marks')->nullable();

            $table->integer('new_marks');

            $table->timestamp('entered_at')->useCurrent();

            $table->timestamps();

            $table->index(
                ['examination_result_id', 'component'],
                'score_audit_result_component_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examination_score_audits');
    }
};
