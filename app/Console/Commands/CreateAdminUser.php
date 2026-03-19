<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Modules\Users\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create a new admin user interactively';

    public function handle(): int
    {
        $this->info('Creating a new admin user...');
        $this->newLine();

        $name     = $this->ask('Name');
        $nickname = $this->ask('Nickname (optional)', null);
        $email    = $this->ask('Email');
        $password = $this->secret('Password (min 8 characters)');

        $validator = Validator::make(
            ['name' => $name, 'email' => $email, 'password' => $password],
            [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:8'],
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return self::FAILURE;
        }

        $user = User::create([
            'name'     => $name,
            'nickname' => $nickname,
            'email'    => $email,
            'password' => Hash::make($password),
            'role'     => UserRole::Admin,
            'active'   => true,
            'dormant'  => false,
        ]);

        $this->newLine();
        $this->info('Admin user created successfully.');
        $this->table(
            ['Field', 'Value'],
            [
                ['Name', $user->name],
                ['Email', $user->email],
                ['Role', $user->role->value],
            ]
        );

        return self::SUCCESS;
    }
}
