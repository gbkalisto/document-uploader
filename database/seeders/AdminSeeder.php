<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@example.com'], // Prevents duplicate entries if run twice
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'phone' => '9876543210',
                'password' => Hash::make('password'),
                'address' => '70881 Dasia Estate Lake Gerardofort, NH 30566-8588',
                'status' => true,
            ]
        );
    }
}
