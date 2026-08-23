<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@tumbang.test',
            ],
            [
                'name' => 'Administrator',
                'address' => 'Tumbang Smart Kids RSIB',
                'role' => 'admin',
                'status' => 'active',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
