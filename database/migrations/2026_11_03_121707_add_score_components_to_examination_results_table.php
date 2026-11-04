<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('examination_results', function (Blueprint $table) {
            $table->unsignedInteger('ca_marks')->nullable()->after('marks_obtained');

            $table->unsignedInteger('objective_marks')->nullable()->after('ca_marks');

            $table->unsignedInteger('theory_marks')->nullable()->after('objective_marks');
        });
    }

    public function down(): void
    {
        Schema::table('examination_results', function (Blueprint $table) {
            $table->dropColumn([
                'ca_marks',
                'objective_marks',
                'theory_marks',
            ]);
        });
    }
};