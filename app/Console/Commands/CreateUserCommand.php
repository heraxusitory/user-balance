<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';
    private $password;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        do {
            $name = $this->ask('What is your name?', 'Richard');
        } while (!$name);

        $email = $this->ask('Enter your email', 'test@test.com');

        while (User::query()->where('email', $email)->exists()) {
            $this->error('User with this email already exists');
            $email = $this->ask('Enter your email', 'test@test.com');
        }


        while (!$this->isMatchedPasswords()) {
            $this->error('Passwords do not match');
        }

        User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($this->getPassword()),
        ]);

        $this->info("User {$name} was created successfully!");

        return 0;
    }

    private function isMatchedPasswords(): bool
    {
        while (!$password = $this->secret('Enter your password')) {
            $this->error('Password is required');
        }
        $confirm = $this->secret('Confirm your password');

        if ($password === $confirm) {
            $this->setPassword($password);
            return true;
        }
        return false;
    }

    private function setPassword($password)
    {
        $this->password = $password;
    }

    private function getPassword()
    {
        return $this->password;
    }
}
