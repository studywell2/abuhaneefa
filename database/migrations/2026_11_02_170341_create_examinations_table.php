<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();

            // Examination information
            $table->string('title');
            $table->string('subject');

            // Class taking the examination
            $table->foreignId('school_class_id')
                ->constrained('school_classes')
                ->restrictOnDelete();

            // Academic information
            $table->string('academic_year', 20);
            $table->string('term', 20);

            // Examination settings
            $table->unsignedInteger('duration_minutes');
            $table->unsignedInteger('total_marks');
            $table->unsignedInteger('pass_mark');

            // Online or physical examination
            $table->string('mode', 20)->default('online');

            // Examination schedule
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();

            // Instructions for students
            $table->text('instructions')->nullable();

            // Examination status
            $table->string('status', 20)->default('draft');

            // Administrator who created the examination
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['school_class_id', 'status']);
            $table->index(['academic_year', 'term']);
            $table->index('start_time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
