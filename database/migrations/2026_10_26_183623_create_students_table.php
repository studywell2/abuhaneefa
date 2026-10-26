<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('admission_number')->unique();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_names')->nullable();

            $table->string('class_name', 30);

            $table->date('date_of_birth')->nullable();
            $table->string('gender', 20)->nullable();

            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone', 30)->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
