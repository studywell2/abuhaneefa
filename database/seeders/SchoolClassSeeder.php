<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['name' => 'JSS1', 'level' => 'junior', 'arm' => null],
            ['name' => 'JSS2', 'level' => 'junior', 'arm' => null],
            ['name' => 'JSS3', 'level' => 'junior', 'arm' => null],
            ['name' => 'SS1', 'level' => 'senior', 'arm' => null],
            ['name' => 'SS2', 'level' => 'senior', 'arm' => null],
            ['name' => 'SS3', 'level' => 'senior', 'arm' => null],
        ];

        foreach ($classes as $class) {
            SchoolClass::updateOrCreate(
                ['name' => $class['name']],
                [
                    'level' => $class['level'],
                    'arm' => $class['arm'],
                    'is_active' => true,
                ]
            );
        }
    }
}
