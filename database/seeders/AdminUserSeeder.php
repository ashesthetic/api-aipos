<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Administrator',
                'nickname' => 'Admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('11111111'),
                'role'     => UserRole::Admin,
                'active'   => true,
                'dormant'  => false,
            ]
        );
    }
}
