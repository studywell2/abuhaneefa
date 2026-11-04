<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('examination_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('examination_id')
                ->constrained('examinations')
                ->cascadeOnDelete();

            $table->foreignId('examiner_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('assigned_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamp('assigned_at')->useCurrent();

            $table->timestamps();

            // Prevent assigning the same examiner twice to one examination.
            $table->unique(
                ['examination_id', 'examiner_id'],
                'unique_examination_examiner'
            );

            $table->index('examiner_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examination_assignments');
    }
};
