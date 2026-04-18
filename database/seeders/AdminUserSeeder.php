<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@balance.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@balance.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );
    }
}
