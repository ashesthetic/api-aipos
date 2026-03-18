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
        $users = [
            [
                'name'     => 'Administrator',
                'nickname' => 'Admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('11111111'),
                'role'     => UserRole::Admin,
            ],
            [
                'name'     => 'Manager',
                'nickname' => 'Manager',
                'email'    => 'manager@gmail.com',
                'password' => Hash::make('111111'),
                'role'     => UserRole::Manager,
            ],
            [
                'name'     => 'Staff',
                'nickname' => 'Staff',
                'email'    => 'staff@gmail.com',
                'password' => Hash::make('111111'),
                'role'     => UserRole::Staff,
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                array_merge($data, ['active' => true, 'dormant' => false])
            );
        }
    }
}
