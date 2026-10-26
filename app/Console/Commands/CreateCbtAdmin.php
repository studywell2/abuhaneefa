<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateCbtAdmin extends Command
{
    protected $signature = 'app:create-cbt-admin';

    protected $description = 'Create the first CBT administrator account';

    public function handle(): int
    {
        $name = trim((string) $this->ask('Administrator name'));

        if ($name === '') {
            $this->error('The name cannot be empty.');

            return self::FAILURE;
        }

        $email = strtolower(trim((string) $this->ask('Administrator email')));

        $validator = Validator::make(
            ['email' => $email],
            ['email' => ['required', 'email', 'max:255']]
        );

        if ($validator->fails()) {
            $this->error('Please enter a valid email address.');

            return self::FAILURE;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('This email already belongs to an existing user.');
            $this->line('No account was created or changed.');

            return self::FAILURE;
        }

        $password = (string) $this->secret('Enter administrator password');

        if (strlen($password) < 12) {
            $this->error('Use a password containing at least 12 characters.');

            return self::FAILURE;
        }

        $confirmation = (string) $this->secret('Confirm administrator password');

        if ($password !== $confirmation) {
            $this->error('The passwords do not match.');

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => 'administrator',
        ]);

        $this->newLine();
        $this->info('CBT administrator created successfully.');
        $this->line('You can now sign in at /cbt/login.');

        return self::SUCCESS;
    }
}
