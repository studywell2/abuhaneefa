<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateInitialAdmin extends Command
{
    protected $signature = 'admin:create-initial';

    protected $description = 'Safely create the initial administrator account';

    public function handle(): int
    {
        if (config('database.default') !== 'mysql') {
            $this->error('Aborted: MySQL is not the default database.');
            return self::FAILURE;
        }

        try {
            DB::connection('mysql')->getPdo();

            $email = 'admin@abuhaneefa.com';

            if (User::where('email', $email)->exists()) {
                $this->error('An account with this email already exists.');
                return self::FAILURE;
            }

            $password = $this->secret('Admin@12345');

            if (!$password || strlen($password) < 12) {
                $this->error('Password must contain at least 12 characters.');
                return self::FAILURE;
            }

            $confirmation = $this->secret('Confirm the administrator password');

            if ($password !== $confirmation) {
                $this->error('Passwords do not match.');
                return self::FAILURE;
            }

            $user = User::create([
                'name' => 'System Administrator',
                'email' => $email,
                'password' => $password,
                'role' => 'administrator',
                'is_active' => true,
            ]);

            $this->info('Administrator account created successfully.');
            $this->info('Email: ' . $user->email);
            $this->info('Role: ' . $user->role);

            return self::SUCCESS;

        } catch (\Throwable $e) {
            $this->error('Administrator creation failed.');
            report($e);

            return self::FAILURE;
        }
    }
}