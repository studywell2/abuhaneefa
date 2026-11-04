<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('examinations', function (Blueprint $table) {
            $table->unsignedInteger('ca_total')->default(20);
            $table->unsignedInteger('objective_total')->default(30);
            $table->unsignedInteger('theory_total')->default(50);
        });
    }

    public function down(): void
    {
        Schema::table('examinations', function (Blueprint $table) {
            $table->dropColumn([
                'ca_total',
                'objective_total',
                'theory_total',
            ]);
        });
    }
};
