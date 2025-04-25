<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Check if the admin user already exists
        if (!User::where('email', 'admin@smakartinibatam')->exists()) {
            // Create the admin user
            User::create([
                'name' => 'Admin',
                'email' => 'admin@smakartinibatam',
                'password' => Hash::make('AdminPassword'), // Change 'password' to a secure password
                'role' => 'admin', // Assuming you have an is_admin field
            ]);
        }
    }
}
