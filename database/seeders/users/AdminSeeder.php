<?php

namespace Database\Seeders\users;

use App\Models\Users\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'Ziad Gamal',
                'email' => 'zyadgamal450@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];
        
        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
